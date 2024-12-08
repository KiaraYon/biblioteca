@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Rol</h1>
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Rol</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="mb-3">
                <label for="permisos" class="form-label">Permisos</label>
                <div>
                    @foreach ($permisos as $permiso)
                        <div>
                            <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}"> {{ $permiso->nombre }}
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
