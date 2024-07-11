<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $libro->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('titulo', 'Título del libro') }}
            {{ Form::text('titulo', $libro->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Título']) }}
            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('autor') }}
            {{ Form::select('id_autor',$autores, $libro->id_autor, ['class' => 'form-control' . ($errors->has('id_autor') ? ' is-invalid' : ''), 'placeholder' => 'Autor']) }}
            {!! $errors->first('id_autor', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('editorial') }}
            {{ Form::select('id_editorial',$editoriales, $libro->id_editorial, ['class' => 'form-control' . ($errors->has('id_editorial') ? ' is-invalid' : ''), 'placeholder' => 'Editorial']) }}
            {!! $errors->first('id_editorial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('materia') }}
            {{ Form::select('id_materia',$materias, $libro->id_materia, ['class' => 'form-control' . ($errors->has('id_materia') ? ' is-invalid' : ''), 'placeholder' => 'Materia']) }}
            {!! $errors->first('id_materia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('anio_edicion') }}
            {{ Form::date('anio_edicion', $libro->anio_edicion, ['class' => 'form-control' . ($errors->has('anio_edicion') ? ' is-invalid' : ''), 'placeholder' => 'Anio Edicion']) }}
            {!! $errors->first('anio_edicion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('num_pagina') }}
            {{ Form::text('num_pagina', $libro->num_pagina, ['class' => 'form-control' . ($errors->has('num_pagina') ? ' is-invalid' : ''), 'placeholder' => 'Num Pagina']) }}
            {!! $errors->first('num_pagina', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $libro->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-2">
            {{ Form::label('imagen', 'Imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : '')]) }}

            @if(isset($libro->id) && $libro->imagen != 'noimage.jpg')
                <img src="{{ asset('storage/uploads/' . $libro->imagen) }}" width="200" height="200" class="img-thumbnail img-fluid">
            @endif
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado', 'Estado') }}
            {{ Form::select('estado', [1 => 'Activo', 0 => 'Inactivo'], $libro->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a class="btn btn-primary" href="{{ route('libros.index') }}"> {{ __('Regresar') }}</a>
    </div>
</div>
