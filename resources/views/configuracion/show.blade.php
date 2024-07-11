@extends('layouts.app')

@section('template_title')
    {{ $configuracion->name ?? __('Show') . " " . __('Configuracion') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Configuracion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('configuraciones.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $configuracion->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $configuracion->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $configuracion->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $configuracion->direccion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
