@extends('layouts.app')

@section('template_title')
    {{ $libro->name ?? __('Show') . " " . __('Libro') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Libro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('libros.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">


                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $libro->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Autor:</strong>
                           {{ $libro->autor->autor }}
                        </div>
                        <div class="form-group">
                            <strong>Editorial:</strong>
                            {{ $libro->editorial->editorial }}
                        </div>
                        <div class="form-group">
                            <strong>Materia:</strong>
                            {{ $libro->materium->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Anio Edicion:</strong>
                            {{ $libro->anio_edicion }}
                        </div>
                        <div class="form-group">
                            <strong>Num Pagina:</strong>
                            {{ $libro->num_pagina }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $libro->descripcion }}
                        </div>
                        <div class="form-group mt-2">
                            <strong>Imagen:</strong>
                            <br>
                            @if($libro->imagen != 'noimage.jpg')
                                <img src="{{ asset('storage/uploads/' . $libro->imagen) }}" width="200" height="200" class="img-thumbnail img-fluid">
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $libro->estado }}
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
