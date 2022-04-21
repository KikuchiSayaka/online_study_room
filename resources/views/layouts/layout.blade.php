<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>共通レイアウト</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body class="vh-100 d-flex justify-content-center text-center">
        <div class="w-75 mt-3">
            <div class="text-black-50 text-left border-bottom mt-5">
                <h1>共通レイアウト</h1>
            </div>

            <div>
                @yield('content')
            </div>
        </div>

    </body>
</html>
