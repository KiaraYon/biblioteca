<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Libro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtén los libros ordenados por cantidad y luego por título
        $libros = Libro::orderBy('cantidad', 'desc')
                        ->orderBy('titulo')
                        ->take(10)
                        ->get();

        // Prepara los títulos y cantidades para la gráfica
        $titulos = $libros->pluck('titulo');
        $cantidades = $libros->pluck('cantidad');

        // Obtener fecha actual
        $now = now();
        // Datos de estudiantes con préstamos próximos a vencer o vencidos y aún activos
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
                $devolucion = strtotime($prestamo->fecha_devolucion);
                // Calcular si el préstamo está vencido o por vencer
                if ($devolucion < $now->timestamp) {
                    $prestamo->color = 'table-danger';
                    $prestamo->estatus = 'Vencido';
                    return true;
                } elseif ($devolucion <= $now->copy()->addDays(15)->timestamp) {
                    $prestamo->color = 'table-warning';
                    $prestamo->estatus = 'Por Vencer';
                    return true;
                }
                return false;
            });
            return $estudiante;
        });

        return view('home', compact('titulos', 'cantidades', 'estudiantesConPrestamos'));
    }

}