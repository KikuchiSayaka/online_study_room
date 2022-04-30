<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div>
            @yield('header')
        </div>

        <div class="top-cover">
            <div class="container">
                <h2 class="text-center pt-5 mt-5 mb-1">登録なしですぐ始められるオンライン自習室</h2>
                <p class="text-center m-3 fs-5">ボタンを押すとすぐに勉強が始められます。</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <button class="btn join-btn">入室</button>
                </form>
            </div>
        </div>

        <footer class="text-center">
            <small>© 2022 Sayaka Kikuchi All rights reserved.</small>
        </footer>
    </body>
</html>
