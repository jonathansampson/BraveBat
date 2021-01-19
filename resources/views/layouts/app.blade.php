<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BraveBat | @yield('title' , "Resource on Brave Browser, BAT and Beyond")</title>
    <meta name="description"
        content="@yield('description', 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate communities')" />

    <meta property='og:site_name' content='BraveBat'>
    <meta property='twitter:site' content='@BraveBatInfo'>
    <meta property='og:title' content='BraveBat'>
    <meta property='og:description'
        content="@yield('description' , 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate communities')">
    <meta property='og:image' content='https://bravebat.info/images/logos/apple-icon-152.png'>
    <meta property='og:url' content='{{URL::current()}}'>
    <meta property='og:type' content='website'>

    <link rel="shortcut icon" href="/images/favicon.svg" type="image/x-icon" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    @laravelPWA

    @if (app()->environment('production'))
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163561589-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-163561589-1');

    </script>
    @endif
</head>

<body class="antialiased text-brand-dark">
    <div id="app" class="flex flex-col min-h-screen">

        @include('partials.nav')
        <main class="flex-grow">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>