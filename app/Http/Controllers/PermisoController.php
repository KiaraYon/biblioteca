<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

/**
 * Class PermisoController
 * @package App\Http\Controllers
 */
class PermisoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-permisos')->only(['index', 'show']);
        $this->middleware('permission:crear-permisos')->only(['create', 'store']);
        $this->middleware('permission:editar-permisos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-permisos')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::paginate(10);

        return view('permiso.index', compact('permisos'))
            ->with('i', (request()->input('page', 1) - 1) * $permisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permiso = new Permiso();
        return view('permiso.create', compact('permiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Permiso::$rules);

        $permiso = Permiso::create($request->all());

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permiso = Permiso::find($id);

        return view('permiso.show', compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permiso = Permiso::find($id);

        return view('permiso.edit', compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        request()->validate(Permiso::$rules);

        $permiso->update($request->all());

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id)->delete();

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso deleted successfully');
    }
}
