<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('autor') }}
            {{ Form::text('autor', $autor->autor, ['class' => 'form-control' . ($errors->has('autor') ? ' is-invalid' : ''), 'placeholder' => 'Autor']) }}
            {!! $errors->first('autor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-2">
            {{ Form::label('imagen', 'Imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : '')]) }}

            @if(isset($autor->id) && $autor->imagen != 'noimage.jpg')
                <img src="{{ asset('storage/uploads/' . $autor->imagen) }}" width="200" height="200" class="img-thumbnail img-fluid">
            @endif
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('estado', 'Estado') }}
            {{ Form::select('estado', [1 => 'Activo', 0 => 'Inactivo'], $autor->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a class="btn btn-primary" href="{{ route('autors.index') }}"> {{ __('Regresar') }}</a>
    </div>
    <div class="float-right">

    </div>
</div>
