@extends('layouts.app')

@section('template_title')
    {{ $materium->name ?? __('Show') . " " . __('Materia') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Materia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('materia.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $materium->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $materium->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
