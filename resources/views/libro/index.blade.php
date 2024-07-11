@extends('layouts.app')

@section('template_title')
    Libro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Libros') }}
                            </span>

                            <form action="{{ route('libros.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar libros...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                             <div class="float-right">
                                 @if(auth()->user()->hasPermission('ver-libros'))
                                <a href="{{ route('libros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Titulo</th>
										<th>Cantidad</th>
										<th>Autor</th>
										<th>Editorial</th>
										<th>Materia</th>

										<th>Imagen</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $libro->titulo }}</td>
											<td>{{ $libro->cantidad }}</td>
											<td>{{ $libro->autor->autor }}</td>
											<td>{{ $libro->editorial->editorial }}</td>
											<td>{{ $libro->materium->nombre }}</td>

											<td>
                                                @if($libro->imagen != 'noimage.jpg')
                                                    <img src="{{ asset('storage/uploads/' . $libro->imagen) }}" width="100" height="100" class="img-thumbnail img-fluid">
                                                @endif
                                            </td>
                                            <td>{{ $libro->estado ? 'Activo' : 'Inactivo' }}</td>

                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    @if(auth()->user()->hasPermission('ver-libros'))
                                                        <a class="btn btn-sm btn-primary" href="{{ route('libros.show', $libro->id) }}">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('libros.edit', $libro->id) }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $libros->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
