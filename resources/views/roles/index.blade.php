@extends('layouts.app')

@section('template_title')
    Roles
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Roles') }}
                            </span>

                            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">
                                {{ __('Crear Nuevo Rol') }}
                            </a>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = ($roles->currentPage() - 1) * $roles->perPage(); @endphp
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->nombre }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $roles->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
