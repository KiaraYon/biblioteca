@extends('layouts.app')

@section('template_title')
    {{ $estudiante->name ?? __('Show') . " " . __('Estudiante') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Estudiante</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('estudiantes.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $estudiante->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Dpi:</strong>
                            {{ $estudiante->dpi }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $estudiante->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Carrera:</strong>
                            {{ $estudiante->carrera }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $estudiante->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $estudiante->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $estudiante->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
