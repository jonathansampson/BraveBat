<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BraveBat | @yield('title' , "Resources on Brave Browser and BAT (Basic Attention Token)")</title>
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
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MSTTHK8');
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