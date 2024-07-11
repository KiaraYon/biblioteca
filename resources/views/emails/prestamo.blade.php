<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo Electrónico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header, .email-footer {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px 5px 0 0;
        }
        .email-footer {
            border-radius: 0 0 5px 5px;
        }
        .email-body {
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ffffff;
        }
        p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="width: 100%; max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center; background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px 5px 0 0;">
            <h1 style="font-size: 24px; margin-bottom: 20px; color: #ffffff;">{{ $data['title'] }}</h1>
        </div>
        <div style="padding: 20px;">
            <p>Se ha registrado un préstamo de libro para ti. Los detalles son los siguientes:</p>
            <p>
                <strong>Libro:</strong> {{ $data['libro'] }}<br>
                <strong>Cantidad:</strong> {{ $data['cantidad'] }}<br>
                <strong>Fecha de Préstamo:</strong> {{ $data['fecha_prestamo'] }}<br>
                <strong>Fecha de Devolución:</strong> {{ $data['fecha_devolucion'] }}
            </p>
        </div>
        <div style="text-align: center; background-color: #007bff; color: white; padding: 10px 20px; border-radius: 0 0 5px 5px;">
            <p style="margin: 0;">Gracias,<br>Biblioteca Sanarate</p>
        </div>
    </div>
</body>
</html>
