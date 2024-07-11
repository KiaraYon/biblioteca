@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Libros Disponibles') }}</div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="miGrafica"></canvas>
                </div>
            </div>

            <!-- Tabla para mostrar estudiantes con préstamos activos -->
            <div class="card mt-4">
                <div class="card-header">{{ __('Estudiantes con Préstamos Activos') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Télefono</th>
                                <th>Libro(s) Prestado(s)</th>
                                <th>Fecha de Préstamo</th>
                                <th>Fecha de Devolución</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantesConPrestamos as $estudiante)
                                @foreach ($estudiante->prestamos as $prestamo)
                                    <tr class="{{ $prestamo->color }}">
                                        <td>{{ $estudiante->nombre }}</td>
                                        <td>{{ $estudiante->codigo }}</td>
                                        <td>{{ $estudiante->telefono }}</td>
                                        <td>{{ $prestamo->libro->titulo }}</td>
                                        <td>{{ $prestamo->fecha_prestamo }}</td>
                                        <td>{{ $prestamo->fecha_devolucion }}</td>
                                        <td>{{ $prestamo->estatus }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    window.onload = function() {
        const ctx = document.getElementById('miGrafica').getContext('2d');
        const fullLabels = @json($titulos); // Etiquetas completas para los tooltips
        const labels = fullLabels.map(label => label.length > 15 ? label.slice(0, 15) + '...' : label); // Acorta las etiquetas para el eje X
        const data = @json($cantidades);

        const miGrafica = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Libros',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                // Devuelve la etiqueta completa para el tooltip
                                return fullLabels[context[0].dataIndex];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        ticks: {
                            callback: function(value, index, values) {
                                // Esto asegurará que las etiquetas sean cortas en el eje X
                                return labels[index];
                            }
                        }
                    }
                }
            }
        });
    };
</script>



@endsection
