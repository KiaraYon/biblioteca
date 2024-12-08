@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Usuarios') }}
                            </span>

                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar usuarios...">
                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="float-right">
                                @if(auth()->user()->hasPermission('crear-usuarios'))
                                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">
                                        {{ __('Crear Nuevo Usuario') }}
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
                                    <th>Correo Electrónico</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @if(auth()->user()->hasPermission('ver-usuarios'))
                                                    <a class="btn btn-sm btn-primary" href="{{ route('users.show', $user->id) }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @endif
                                                @if(auth()->user()->hasPermission('editar-usuarios'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(auth()->user()->hasPermission('eliminar-usuarios'))
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
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
                {!! $users->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
