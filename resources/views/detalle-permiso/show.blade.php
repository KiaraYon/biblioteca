@extends('layouts.app')

@section('template_title')
    {{ $detallePermiso->name ?? __('Show') . " " . __('Detalle Permiso') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Detalle Permiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-permisos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Id Usuario:</strong>
                            {{ $detallePermiso->id_usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Id Permiso:</strong>
                            {{ $detallePermiso->id_permiso }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
