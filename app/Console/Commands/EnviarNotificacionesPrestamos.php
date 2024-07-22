<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EnviarNotificacionesPrestamos extends Command
{
    protected $signature = 'prestamos:enviar-notificaciones';
    protected $description = 'Enviar notificaciones de WhatsApp para préstamos a punto de vencer o vencidos';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now()->startOfDay();
        $estudiantesConPrestamos = Estudiante::whereHas('prestamos', function ($query) use ($now) {
            $query->where('estado', 1)
                ->where(function ($query) use ($now) {
                    $query->where('fecha_devolucion', '<=', $now->copy()->addDays(15))
                          ->where('fecha_devolucion', '>=', $now);
                });
        })->with(['prestamos' => function ($query) use ($now) {
            $query->where('estado', 1)
                ->where(function ($query) use ($now) {
                    $query->where('fecha_devolucion', '<=', $now->copy()->addDays(15))
                          ->where('fecha_devolucion', '>=', $now);
                });
        }])->get()->map(function ($estudiante) use ($now) {
            $estudiante->prestamos = $estudiante->prestamos->filter(function ($prestamo) use ($now) {
                $devolucion = Carbon::parse($prestamo->fecha_devolucion)->startOfDay();
                if ($devolucion < $now) {
                    $prestamo->color = 'table-danger';
                    $prestamo->estatus = 'Vencido';
                    return true;
                } elseif ($devolucion <= $now->copy()->addDays(15)) {
                    $prestamo->color = 'table-warning';
                    $prestamo->estatus = 'Por Vencer';
                    return true;
                }
                return false;
            });
            return $estudiante;
        });

        $this->enviarNotificaciones($estudiantesConPrestamos, $now);
    }

    private function enviarNotificaciones($estudiantesConPrestamos, $now)
    {

        foreach ($estudiantesConPrestamos as $estudiante) {
            foreach ($estudiante->prestamos as $prestamo) {
                $fechaDevolucion = Carbon::parse($prestamo->fecha_devolucion)->startOfDay();
                $diffInDays = $fechaDevolucion->diffInDays($now);

                Log::info("Fecha devolucion '{$fechaDevolucion}' diferencia de dias {$diffInDays}");
                Log::info("Revisando préstamo para el libro '{$prestamo->libro->titulo}' con fecha de devolución {$fechaDevolucion}, diferencia de días: {$diffInDays}");

                // Verificar si está a 15, 10, 5, 1 días antes o si ya venció
                if (in_array($diffInDays, [15, 10, 5, 1])) {
                    $diasRestantes = $diffInDays === 1 ? "mañana" : "en {$diffInDays} días";
                    Log::info("Préstamo del libro '{$prestamo->libro->titulo}' está a punto de vencer {$diasRestantes}.");
                    $this->enviarNotificacion($estudiante->telefono, "Tu préstamo del libro '{$prestamo->libro->titulo}' está a punto de vencer {$diasRestantes}.");
                }

                if ($fechaDevolucion->isToday() && $prestamo->estatus != 'Vencido') {
                    Log::info("Préstamo del libro '{$prestamo->libro->titulo}' ha vencido hoy.");
                    $prestamo->estatus = 'Vencido';
                    $prestamo->save();
                    $this->enviarNotificacion($estudiante->telefono, "Tu préstamo del libro '{$prestamo->libro->titulo}' ha vencido hoy.");
                }
            }
        }
    }

    private function enviarNotificacion($telefono, $mensaje)
    {
        try {
            $response = Http::get('http://127.0.0.1:8000/send-notification', [
                'phone' => $telefono,
                'message' => $mensaje,
            ]);

            if ($response->successful()) {
                Log::info('Notificación de WhatsApp enviada exitosamente.');
            } else {
                Log::error('Error al enviar la notificación de WhatsApp: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Excepción al enviar la notificación de WhatsApp: ' . $e->getMessage());
        }
    }
}