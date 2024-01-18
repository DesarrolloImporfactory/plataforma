<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a Imporsuit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            padding: 20px;
        }
        .content {
            background: #fff;
            padding: 30px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Hola {{ $user->name }}, bienvenido a Imporsuit!</h1>
            <p>Te has registrado exitosamente en nuestra plataforma.</p>
            <p>Aquí tienes algunos detalles importantes sobre tu cuenta:</p>
            <ul>
                <li>Email: {{ $user->email }}</li>
                <li>Teléfono: {{ $user->telefono }}</li>
                <li>Enlace de Tienda: <a href="{{ $user->url }}">{{ $user->url }}</a></li>
            </ul>
            <p>Para comenzar a utilizar tu cuenta, por favor verifica tu email haciendo clic en el siguiente enlace:</p>
            <a href="{{ url('/verify?email=' . $user->email) }}" style="display: inline-block; background: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Verificar Email</a>
            <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p>Saludos,<br>El equipo de Imporsuit</p>
        </div>
    </div>
</body>
</html>