<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="imagex/png" href="{{ URL::asset('img/logo2.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        body {
            background: #EEEEEE;
          
        }

    </style>
</head>

<body>
    @inertia

    @env('local')
    <!--<script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>-->
    @endenv
</body>

</html>
