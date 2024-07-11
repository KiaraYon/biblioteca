@extends('layouts.app')

@section('template_title')
    Materia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Materias') }}
                            </span>

                            <form action="{{ route('materia.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar materias...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary ">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                             <div class="float-right">
                                 @if(auth()->user()->hasPermission('ver-materias'))
                                <a href="{{ route('materia.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

										<th>Nombre</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materia as $materium)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $materium->nombre }}</td>
                                            <td>{{ $materium->estado ? 'Activo' : 'Inactivo' }}</td>

                                            <td>
                                                <form action="{{ route('materia.destroy',$materium->id) }}" method="POST">
                                                     @if(auth()->user()->hasPermission('ver-materias'))
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('materia.show',$materium->id) }}"><i class="bi bi-trash"></i></a> --}}
                                                    @endif
                                                     @if(auth()->user()->hasPermission('ver-materias'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('materia.edit',$materium->id) }}"><i class="bi bi-pencil"></i></a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                     @if(auth()->user()->hasPermission('ver-materias'))
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
                {!! $materia->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
