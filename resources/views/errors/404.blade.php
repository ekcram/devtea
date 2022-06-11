<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Error 404') }} - Error 404</title>

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
                Oops....Esta página no existe... haz click
                <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-800">aquí</a>
                para volver a la página.
            </h1>
            <img src="https://www.trecebits.com/wp-content/uploads/2020/11/Error-404.jpg" alt="error" class="mt-5">
        </div>
    </body>
</html>