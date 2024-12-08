@extends('layouts.app')

@section('template_title')
    Editar Rol
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Rol</div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Rol</label>
                                <input type="text" name="nombre" value="{{ $role->nombre }}" class="form-control" placeholder="Nombre del rol">
                                @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="permisos" class="form-label">Permisos</label>
                                <div>
                                    @foreach ($permisos as $permiso)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                                                   id="permiso{{ $permiso->id }}"
                                                {{ $role->permisos->contains($permiso->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permiso{{ $permiso->id }}">
                                                {{ $permiso->nombre }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
