<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('id_usuario', 'Usuario') }}
            {{ Form::select('id_usuario', $usuarios, $detallePermiso->id_usuario, ['class' => 'form-control' . ($errors->has('id_usuario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un usuario']) }}
            {!! $errors->first('id_usuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('id_permiso', 'Permiso') }}
            {{ Form::select('id_permiso', $permisos, $detallePermiso->id_permiso, ['class' => 'form-control' . ($errors->has('id_permiso') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un permiso']) }}
            {!! $errors->first('id_permiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a class="btn btn-primary" href="{{ route('detalle-permisos.index') }}"> {{ __('Regresar') }}</a>
    </div>
</div>
