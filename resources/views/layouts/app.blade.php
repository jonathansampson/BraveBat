<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your comprehensive information source about Brave Browser, Basic Attention Token and their passionate communities"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @if (App::environment('production'))
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163561589-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-163561589-1');
    </script>
@endif
</head>
<body class="antialiased leading-none bg-gray-100">
    <div id="app" class="flex flex-col min-h-screen">
        @include('partials.nav')

        <main class="flex-grow">
            @yield('content')
        </main>
        @include('partials.footer')

    </div>
</body>
</html>

