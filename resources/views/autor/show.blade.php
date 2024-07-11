@extends('layouts.app')

@section('template_title')
    {{ $autor->name ?? __('Show') . " " . __('Autor') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Autor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('autors.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Autor:</strong>
                            {{ $autor->autor }}
                        </div>
                        <div class="form-group mt-2">
                            <strong>Imagen:</strong>
                            <br>
                            @if($autor->imagen != 'noimage.jpg')
                                <img src="{{ asset('storage/uploads/' . $autor->imagen) }}" width="200" height="200" class="img-thumbnail img-fluid">
                            @endif
                        </div>
                        <div class="form-group mt-2">
                            <strong>Estado:</strong>
                            {{ $autor->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
