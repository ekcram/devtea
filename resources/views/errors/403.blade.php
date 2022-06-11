<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Error 403') }} - Error 403</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col justify-center items-center my-auto min-h-screen">
            <h1 class="text-2xl">
                Oops....No estás autorizado para acceder a este contenido.... haz click
                <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-800">aquí</a>
                para volver a la página.
            </h1>
            <img src="https://vocalremover.es/wp-content/uploads/Como-reparar-el-error-403-prohibido-en-Google-Chrome.jpeg" alt="error" class="mt-5">
        </div>
    </body>
</html>