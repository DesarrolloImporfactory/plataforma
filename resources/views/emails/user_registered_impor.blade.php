<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .cuerpo {
            width: 100%;
            height: 100vh;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contenido {
            width: 80%;
            padding-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .img {
            padding-top: 40px;
        }

        img {
            width: 400px;
            height: 100%;
            display: flex;

        }

        .texto {
            padding-top: 40px;
            width: inherit;
        }

        .hola {
            font-size: 20px;
            font-weight: 100;

        }

        .bold {
            font-weight: 700;
        }

        .semibold {
            font-weight: 500;
        }

        .pasos {
            display: grid;
            grid-template-columns: 1fr;
            padding: 0;
            list-style: none;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            img {
                width: 250px;
            }
        }
    </style>
</head>

<body class="cuerpo">
    <div class="contenido">
        <div class="img">
            <img src="https://registro.imporsuit.com/logo_n.png" alt="">
        </div>
        <div class="texto">
            <h1 class="hola">
                Hola <span class="bold">{{$user->name}} </span>
            </h1>
            <p class="semibold">
                ¡Felicidades! ¡Ya eres parte de IMPORSUIT!
            </p>
            <p class="semibold">
                Aquí están tus accesos para ingresar a la plataforma. 🙌
            </p>
            <p class="bold">SIGUE ESTOS PASOS:
            </p>
            <ul class="pasos">
                <li>1️⃣ Abre el enlace de la plataforma. </li>
                <li> 2️⃣ Ingresa usando el usuario y contraseña </li>
                <li> 3️⃣ ¡Ya estás adentro! </li>
            </ul>
            <p class="bold">✅ IMPORSUIT: <a
                    href="https://3fz8vrwgo3.execute-api.us-west-2.amazonaws.com/track?curr_track_type=link_click&link_id=7UkY1M3&temp_id=IjMxMTAyOSI_3D&email_id=mailget_email_id_replace&s_id=mailget_s_id_replace&server=replace_smtp_server&type=replace_drip_type">INGRESAR</a>
            </p>
            <p class="semibold">¡La suite de herramientas, desde infoaduana
                calculadoras, productos, facturación y tienda virtual en un solo lugar!
            </p>
            <p class="bold">USUARIO: {{$user->email}}
            </p>
            <p class="bold"> CONTRASEÑA: import.1
            </p>
            <p class="semibold"> <b> NOTA:</b> Aquí te dejo el link donde tendrás los tutoriales del manejo de la
                plataforma,
                clic acá⬇⬇
            </p>
            <p class="bold">✅ TUTORIALES: <a
                    href="https://3fz8vrwgo3.execute-api.us-west-2.amazonaws.com/track?curr_track_type=link_click&link_id=7UkY1M3&temp_id=IjMxMTAyOSI_3D&email_id=mailget_email_id_replace&s_id=mailget_s_id_replace&server=replace_smtp_server&type=replace_drip_type">VER
                    TUTORIALES</a>
            </p>

            <p class="semibold">
                Si tienes alguna duda comunicate con un asesor <a href="https://wa.link/obd97x">AQUI</a>
            </p>
        </div>
    </div>
</body>

</html>