<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

/**
 * Class EstudianteController
 * @package App\Http\Controllers
 */
class EstudianteController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:ver-estudiantes')->only(['index', 'show']);
        $this->middleware('permission:crear-estudiantes')->only(['create', 'store']);
        $this->middleware('permission:editar-estudiantes')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-estudiantes')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $estudiantes = Estudiante::where('codigo', 'like', "%{$search}%")
                                    ->orWhere('dpi', 'like', "%{$search}%")
                                    ->orWhere('nombre', 'like', "%{$search}%")
                                    ->orWhere('carrera', 'like', "%{$search}%")
                                    ->orWhere('direccion', 'like', "%{$search}%")
                                    ->orWhere('telefono', 'like', "%{$search}%")
                                    ->paginate(5);
        } else {
            $estudiantes = Estudiante::paginate(5);
        }

        return view('estudiante.index', compact('estudiantes'))
                ->with('i', (request()->input('page', 1) - 1) * $estudiantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estudiante = new Estudiante();
        return view('estudiante.create', compact('estudiante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Estudiante::$rules);

        $estudiante = Estudiante::create($request->all());

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        return view('estudiante.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Estudiante::find($id);

        return view('estudiante.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Estudiante $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        request()->validate(Estudiante::$rules);

        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id)->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante deleted successfully');
    }

    public function getCodigo($id)
    {
        $estudiante = Estudiante::find($id);

        return response()->json([
            'codigo' => $estudiante->codigo,
        ]);
    }

}