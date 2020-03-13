<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- css propios -->
    @stack('styles')
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
    <title>@yield('title')</title>
</head>

<body>

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</body>

</html>
