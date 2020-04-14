<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />
    <meta name="Description" content="Coronavirus Tracker">

    <title>Brave BAT</title>
    @if (env('APP_ENV') == 'production')
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163561589-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-163561589-1');
        </script>
    @endif
</head>
<body class='antialiased'>
  <div id='app'>
      @yield('content')
  </div>
    <script src="{{mix('/js/app.js')}}"></script>
    @stack('scripts')
</body>
</html>