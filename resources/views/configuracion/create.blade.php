@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Configuracion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Configuracion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('configuraciones.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('configuracion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
