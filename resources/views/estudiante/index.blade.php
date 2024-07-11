@extends('layouts.app')

@section('template_title')
    Estudiante
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Estudiantes') }}
                            </span>
                            <form action="{{ route('estudiantes.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar estudiantes...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div class="float-right">
                                @if(auth()->user()->hasPermission('crear-estudiantes'))
                                <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

										<th>Codigo</th>
										<th>Nombre</th>
										<th>Carrera</th>
										<th>Telefono</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $estudiante->codigo }}</td>
											<td>{{ $estudiante->nombre }}</td>
											<td>{{ $estudiante->carrera }}</td>
											<td>{{ $estudiante->telefono }}</td>
                                            <td>{{ $estudiante->estado ? 'Activo' : 'Inactivo' }}</td>

                                            <td>
                                                <form action="{{ route('estudiantes.destroy',$estudiante->id) }}" method="POST">
                                                    @if(auth()->user()->hasPermission('ver-estudiantes'))
                                                    <a class="btn btn-sm btn-primary " href="{{ route('estudiantes.show',$estudiante->id) }}"><i class="bi bi-eye"></i></a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('editar-estudiantes'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('estudiantes.edit',$estudiante->id) }}"><i class="bi bi-pencil"></i></a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('eliminar-estudiantes'))
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
                {!! $estudiantes->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
