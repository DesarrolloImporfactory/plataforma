<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- tailwind --}}
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto">
        <div class="bg-gray-100 p-4">
            <h1 class="text-2xl font-bold">¡Felicidades!</h1>
            <p class="text-lg">¡Ya eres parte de la METODOLOGIA ECOMMERCE!</p>
            <p class="text-lg">⚠️ IMPORTANTE ⚠️</p>
            <p class="text-lg">Dale clic al botón para revisar instrucciones detalladas de la Metodología Ecommerce 3 en
                1</p>
            <a href="https://ecomm.imporfactoryusa.com/instrucciones-ecommerce-ii" target="_blank"
                class="bg-blue-500 text-white px-4 py-2 rounded">INSTRUCCIONES</a>
            <p class="text-lg">Aquí están tus accesos para ingresar a todas nuestras plataformas. 🙌</p>
        </div>
    </div>
    {{-- vite --}}
    @vite('resources/js/app.js')
</body>

</html>
