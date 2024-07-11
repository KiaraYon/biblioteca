<div class="box box-info padding-1">
    <div class="box-body">
        {{-- <input type="" name="id" value="{{ $editorial->id }}"> --}}

        <div class="form-group">
            {{ Form::label('editorial') }}
            {{ Form::text('editorial', $editorial->editorial, ['class' => 'form-control' . ($errors->has('editorial') ? ' is-invalid' : ''), 'placeholder' => 'Editorial']) }}
            {!! $errors->first('editorial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('estado', 'Estado') }}
            {{ Form::select('estado', [1 => 'Activo', 0 => 'Inactivo'], $editorial->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a class="btn btn-primary" href="{{ route('editoriales.index') }}"> {{ __('Regresar') }}</a>
    </div>
</div>
