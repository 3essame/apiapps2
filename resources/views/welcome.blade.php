<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>التدريب</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        @font-face {
            font-family: 'AraJozoor';
            src: url("{{ asset('fonts/AraJozoor-Regular.ttf') }}");
        }

        #app {
            font-family: 'AraJozoor' !important;
        }

        body {
            font-family: 'AraJozoor';
        }

    </style>
</head>

<body class="antialiased">
    <div id="app">
        <index :settings="{{ $settings }}"></index>
    </div>
    <script src="{{ mix('js/app.js') }}" defere></script>
</body>

</html>
