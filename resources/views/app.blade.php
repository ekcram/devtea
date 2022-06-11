<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'DevTea Demo') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://js.stripe.com/v3/" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        
       

    </head>
    <body class="font-primary antialiased">
        @inertia
    </body>
</html>
