@extends('layouts.app')

@section('template_title')
    {{ $prestamo->name ?? __('Show') . " " . __('Prestamo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Prestamo</span>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('prestamos.index') }}"> {{ __('Regresar') }}</a>
                            <a class="btn btn-secondary" href="{{ route('prestamos.pdf', $prestamo->id) }}"> {{ __('Descargar PDF') }}</a>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Id Estudiante:</strong>
                            {{ $prestamo->estudiante->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Id Libro:</strong>
                            {{ $prestamo->libro->titulo }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Prestamo:</strong>
                            {{ $prestamo->fecha_prestamo }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Devolucion:</strong>
                            {{ $prestamo->fecha_devolucion }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $prestamo->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $prestamo->observacion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $prestamo->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
