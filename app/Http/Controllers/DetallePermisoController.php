<?php

namespace App\Http\Controllers;

use App\Models\DetallePermiso;
use Illuminate\Http\Request;

/**
 * Class DetallePermisoController
 * @package App\Http\Controllers
 */
class DetallePermisoController extends Controller
{
        public function __construct()
    {
        $this->middleware('permission:ver-detalle-permisos')->only(['index', 'show']);
        $this->middleware('permission:crear-detalle-permisos')->only(['create', 'store']);
        $this->middleware('permission:editar-detalle-permisos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-detalle-permisos')->only(['destroy']);
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
            $detallePermisos = DetallePermiso::whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            })
            ->orWhereHas('permiso', function($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->paginate(5);
        } else {
            $detallePermisos = DetallePermiso::paginate(5);
        }

        return view('detalle-permiso.index', compact('detallePermisos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallePermisos->perPage());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
{
    $detallePermiso = new DetallePermiso();
    $usuarios = \App\Models\User::pluck('name', 'id');
    $permisos = \App\Models\Permiso::pluck('nombre', 'id');
    return view('detalle-permiso.create', compact('detallePermiso', 'usuarios', 'permisos'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetallePermiso::$rules);

        $detallePermiso = DetallePermiso::create($request->all());

        return redirect()->route('detalle-permisos.index')
            ->with('success', 'DetallePermiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallePermiso = DetallePermiso::find($id);

        return view('detalle-permiso.show', compact('detallePermiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
{
    $detallePermiso = DetallePermiso::find($id);
    $usuarios = \App\Models\User::pluck('name', 'id');
    $permisos = \App\Models\Permiso::pluck('nombre', 'id');
    return view('detalle-permiso.edit', compact('detallePermiso', 'usuarios', 'permisos'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetallePermiso $detallePermiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePermiso $detallePermiso)
    {
        request()->validate(DetallePermiso::$rules);

        $detallePermiso->update($request->all());

        return redirect()->route('detalle-permisos.index')
            ->with('success', 'DetallePermiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallePermiso = DetallePermiso::find($id)->delete();

        return redirect()->route('detalle-permisos.index')
            ->with('success', 'DetallePermiso deleted successfully');
    }
}