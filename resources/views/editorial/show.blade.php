@extends('layouts.app')

@section('template_title')
    {{ $editorial->name ?? __('Show') . " " . __('Editorial') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Editorial</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('editoriales.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Editorial:</strong>
                            {{ $editorial->editorial }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $editorial->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
