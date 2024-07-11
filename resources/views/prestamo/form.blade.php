<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('id_estudiante', 'Estudiante') }}
            <select name="id_estudiante" id="id_estudiante" class="form-control {{ $errors->has('id_estudiante') ? 'is-invalid' : '' }}">
                <option value="">Seleccione un estudiante</option>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}" data-codigo="{{ $estudiante->codigo }}"
                        {{ $prestamo->id_estudiante == $estudiante->id ? 'selected' : '' }}>
                        {{ $estudiante->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('id_estudiante', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('codigo_estudiante', 'Código del Estudiante') }}
            <input type="text" id="codigo_estudiante" class="form-control" readonly>
        </div>
        <div class="form-group">
            {{ Form::label('id_libro', 'Libro') }}
            {{ Form::select('id_libro', $libros, $prestamo->id_libro, ['class' => 'form-control' . ($errors->has('id_libro') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un libro']) }}
            {!! $errors->first('id_libro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_prestamo', 'Fecha de Préstamo') }}
            {{ Form::date('fecha_prestamo', $prestamo->fecha_prestamo, ['class' => 'form-control' . ($errors->has('fecha_prestamo') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Préstamo']) }}
            {!! $errors->first('fecha_prestamo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_devolucion', 'Fecha de Devolución') }}
            {{ Form::date('fecha_devolucion', $prestamo->fecha_devolucion, ['class' => 'form-control' . ($errors->has('fecha_devolucion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Devolución']) }}
            {!! $errors->first('fecha_devolucion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad', 'Cantidad') }}
            {{ Form::text('cantidad', $prestamo->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('observacion', 'Observación') }}
            {{ Form::text('observacion', $prestamo->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observación']) }}
            {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group " style="display: none;">
            {{ Form::hidden('estado', 1) }}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a class="btn btn-primary" href="{{ route('prestamos.index') }}"> {{ __('Regresar') }}</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var estudianteSelect = document.getElementById('id_estudiante');
        var codigoEstudianteInput = document.getElementById('codigo_estudiante');

        estudianteSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var codigo = selectedOption.getAttribute('data-codigo');
            codigoEstudianteInput.value = codigo || '';
        });

        // Si hay un estudiante seleccionado, cargar el código en el input al cargar la página
        if (estudianteSelect.value) {
            var selectedOption = estudianteSelect.options[estudianteSelect.selectedIndex];
            var codigo = selectedOption.getAttribute('data-codigo');
            codigoEstudianteInput.value = codigo || '';
        }
    });
</script>
