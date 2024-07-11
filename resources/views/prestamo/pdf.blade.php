<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalles del Préstamo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .header { margin-bottom: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin: 0; }
        .header p { font-size: 14px; margin: 0; }
        .footer { text-align: center; font-size: 12px; margin-top: 30px; }
        .details th, .details td { padding: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Biblioteca Pública de la Municipalidad de Sanarate</h1>
            <p>Dirección: Biblioteca Municipal de Sanarate, El Progreso, Guatemala</p>
        </div>
        <div class="content">
            <h2 class="mb-4">Detalles del Préstamo</h2>
            <table class="table table-bordered details">
                <tr>
                    <th>Estudiante</th>
                    <td>{{ $prestamo->estudiante->nombre }}</td>
                </tr>
                <tr>
                    <th>Código del Estudiante</th>
                    <td>{{ $prestamo->estudiante->codigo }}</td>
                </tr>
                <tr>
                    <th>Libro</th>
                    <td>{{ $prestamo->libro->titulo }}</td>
                </tr>
                <tr>
                    <th>Fecha de Préstamo</th>
                    <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Fecha de Devolución</th>
                    <td>{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{ $prestamo->cantidad }}</td>
                </tr>
                <tr>
                    <th>Observación</th>
                    <td>{{ $prestamo->observacion }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $prestamo->estado ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            Biblioteca Pública de Sanarate &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html>
