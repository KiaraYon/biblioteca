<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Services\MailService;

/**
 * Class PrestamoController
 * @package App\Http\Controllers
 */
class PrestamoController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:ver-prestamos')->only(['index', 'show']);
        $this->middleware('permission:crear-prestamos')->only(['create', 'store']);
        $this->middleware('permission:editar-prestamos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-prestamos')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $fechaPrestamo = $request->get('fecha_prestamo');
        $fechaDevolucion = $request->get('fecha_devolucion');

        $prestamos = Prestamo::with(['estudiante', 'libro']);

        if ($search) {
            $prestamos = $prestamos->whereHas('estudiante', function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orWhereHas('libro', function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            });
        }

        // Filtrar por fecha de préstamo
        if ($fechaPrestamo) {
            $prestamos = $prestamos->whereDate('fecha_prestamo', '=', $fechaPrestamo);
        }

        // Filtrar por fecha de devolución
        if ($fechaDevolucion) {
            $prestamos = $prestamos->whereDate('fecha_devolucion', '=', $fechaDevolucion);
        }

        $prestamos = $prestamos->paginate(5);

        return view('prestamo.index', compact('prestamos'))
            ->with('i', (request()->input('page', 1) - 1) * $prestamos->perPage());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prestamo = new Prestamo();
        $estudiantes = Estudiante::select('id', 'nombre', 'codigo')->get();
        $libros = Libro::pluck('titulo','id');
        return view('prestamo.create', compact('prestamo','libros','estudiantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Prestamo::$rules);

        DB::beginTransaction();
        try {
            $libro = Libro::findOrFail($request->input('id_libro'));

            if ($libro->cantidad < $request->input('cantidad')) {
                throw new \Exception('No hay suficientes libros para prestar la cantidad solicitada.');
            }

            $libro->cantidad -= $request->input('cantidad');
            $libro->save();

            $prestamo = Prestamo::create($request->all());

            $estudiante = Estudiante::findOrFail($request->input('id_estudiante'));

            $message = "Préstamo de Libro Creado\n\n" .
                    "Libro: " . $prestamo->libro->titulo . "\n" .
                    "Cantidad: " . $prestamo->cantidad . "\n" .
                    "Fecha de Préstamo: " . $prestamo->fecha_prestamo . "\n" .
                    "Fecha de Devolución: " . $prestamo->fecha_devolucion;

            try {
                $response = Http::get('http://127.0.0.1:8000/send-notification', [
                    'phone' => $estudiante->telefono,
                    'message' => $message,
                ]);

                if ($response->successful()) {
                    Log::info('Notificación de WhatsApp enviada exitosamente.');
                } else {
                    Log::error('Error al enviar la notificación de WhatsApp: ' . $response->body());
                }
            } catch (\Exception $e) {
                Log::error('Excepción al enviar la notificación de WhatsApp: ' . $e->getMessage());
            }

            DB::commit();

            return response()->json(['success' => 'Préstamo creado con éxito.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);
        $estudiantes = Estudiante::select('id', 'nombre', 'codigo')->get();
        $libros = Libro::pluck('titulo', 'id');

        return view('prestamo.edit', compact('prestamo', 'libros', 'estudiantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prestamo $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        request()->validate(Prestamo::$rules);

        DB::beginTransaction();
        try {
            $libro = Libro::findOrFail($prestamo->id_libro);

            $diferenciaCantidad = $request->input('cantidad') - $prestamo->cantidad;

            if ($diferenciaCantidad > 0) {
                if ($libro->cantidad < $diferenciaCantidad) {
                    throw new \Exception('No hay suficientes libros para actualizar el préstamo con esa cantidad.');
                }
                $libro->cantidad -= $diferenciaCantidad;
            } elseif ($diferenciaCantidad < 0) {
                $libro->cantidad += abs($diferenciaCantidad);
            }

            $libro->save();

            $prestamo->update($request->all());

            $estudiante = Estudiante::findOrFail($request->input('id_estudiante'));

            $message = "Préstamo de Libro Actualizado\n\n" .
                       "Libro: " . $prestamo->libro->titulo . "\n" .
                       "Cantidad: " . $prestamo->cantidad . "\n" .
                       "Fecha de Préstamo: " . $prestamo->fecha_prestamo . "\n" .
                       "Fecha de Devolución: " . $prestamo->fecha_devolucion;

            try {
                $response = Http::get('http://127.0.0.1:8000/send-notification', [
                    'phone' => $estudiante->telefono,
                    'message' => $message,
                ]);

                if ($response->successful()) {
                    Log::info('Notificación de WhatsApp enviada exitosamente.');
                } else {
                    Log::error('Error al enviar la notificación de WhatsApp: ' . $response->body());
                }
            } catch (\Exception $e) {
                Log::error('Excepción al enviar la notificación de WhatsApp: ' . $e->getMessage());
            }

            DB::commit();

            return response()->json(['success' => 'Préstamo actualizado con éxito.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function inactivar($id)
    {
        DB::beginTransaction();
        try {
            $prestamo = Prestamo::findOrFail($id);
            $prestamo->estado = 0; // Cambia el estado a "Inactivo"
            $prestamo->save();

            // Obtener información del estudiante
            $estudiante = Estudiante::findOrFail($prestamo->id_estudiante);

            // Datos para la notificación de WhatsApp
            $message = "El libro ha sido entregado.\n\n" .
                    "Libro: " . $prestamo->libro->titulo . "\n" .
                    "Cantidad: " . $prestamo->cantidad . "\n" .
                    "Fecha de Préstamo: " . $prestamo->fecha_prestamo . "\n" .
                    "Fecha de Devolución: " . $prestamo->fecha_devolucion;

            // Enviar notificación de WhatsApp al estudiante
            try {
                $response = Http::get('http://127.0.0.1:8000/send-notification', [
                    'phone' => $estudiante->telefono, // Asegúrate de que este campo esté disponible en tu modelo Estudiante
                    'message' => $message,
                ]);

                if ($response->successful()) {
                    Log::info('Notificación de WhatsApp enviada exitosamente.');
                } else {
                    Log::error('Error al enviar la notificación de WhatsApp: ' . $response->body());
                }
            } catch (\Exception $e) {
                Log::error('Excepción al enviar la notificación de WhatsApp: ' . $e->getMessage());
            }

            DB::commit();

            return response()->json(['success' => 'Prestamo inactivado con éxito.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function generatePdf($id)
    {
        $prestamo = Prestamo::with(['estudiante', 'libro'])->findOrFail($id);
        $pdf = Pdf::loadView('prestamo.pdf', compact('prestamo'));

        return $pdf->download('prestamo_'.$prestamo->id.'.pdf');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id)->delete();

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo deleted successfully');
    }
}