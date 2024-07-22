<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

/**
 * Class ConfiguracionController
 * @package App\Http\Controllers
 */
class ConfiguracionController extends Controller
{
        public function __construct()
    {
        $this->middleware('permission:ver-configuraciones')->only(['index', 'show']);
        $this->middleware('permission:crear-configuraciones')->only(['create', 'store']);
        $this->middleware('permission:editar-configuraciones')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-configuraciones')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracions = Configuracion::paginate();

        return view('configuracion.index', compact('configuracions'))
            ->with('i', (request()->input('page', 1) - 1) * $configuracions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configuracion = new Configuracion();
        return view('configuracion.create', compact('configuracion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Configuracion::$rules);

        $configuracion = Configuracion::create($request->all());

        return redirect()->route('configuracions.index')
            ->with('success', 'Configuracion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configuracion = Configuracion::find($id);

        return view('configuracion.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuracion = Configuracion::find($id);

        return view('configuracion.edit', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Configuracion $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracion $configuracion)
    {
        request()->validate(Configuracion::$rules);

        $configuracion->update($request->all());

        return redirect()->route('configuracions.index')
            ->with('success', 'Configuracion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $configuracion = Configuracion::find($id)->delete();

        return redirect()->route('configuracions.index')
            ->with('success', 'Configuracion deleted successfully');
    }
}