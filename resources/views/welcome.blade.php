<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- we add bootstrap grid in all.css thats we we did not include app css --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="css/blog/all.css" rel="stylesheet">
    
        <!-- Styles -->
        <style>
           
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="app">
            <main-component></main-component>
            {{-- <router-view></router-view> --}}
        </div>
       <script src="{{ mix('/js/app.js') }}" defer></script>
    </body>
</html>
