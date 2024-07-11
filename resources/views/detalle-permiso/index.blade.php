@extends('layouts.app')

@section('template_title')
    Detalle Permiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Permiso') }}
                            </span>

                            <form action="{{ route('detalle-permisos.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar ...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                             <div class="float-right">
                                @if(auth()->user()->hasPermission('ver-permisos'))
                                <a href="{{ route('detalle-permisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                @endif
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Usuario</th>
                                        <th>Id Usuario</th>
                                        <th>Permiso</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallePermisos as $detallePermiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $detallePermiso->user->name }}</td>
                                            <td>{{ $detallePermiso->user->id }}</td>
                                            <td>{{ $detallePermiso->permiso->nombre }}</td>

                                            <td>
                                                <form action="{{ route('detalle-permisos.destroy',$detallePermiso->id) }}" method="POST">
                                                    @if(auth()->user()->hasPermission('ver-permisos'))
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('detalle-permisos.show',$detallePermiso->id) }}"><i class="bi bi-eye"></i></a> --}}
                                                    @endif
                                                    @if(auth()->user()->hasPermission('ver-permisos'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-permisos.edit',$detallePermiso->id) }}"><i class="bi bi-pencil"></i></a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('ver-permisos'))
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallePermisos->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
