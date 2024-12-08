<div class="form-group">
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('email', 'Correo Electrónico') }}
    {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo Electrónico']) }}
    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('password', 'Contraseña') }}
    {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('password_confirmation', 'Confirmar Contraseña') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Contraseña']) }}
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
</div>
