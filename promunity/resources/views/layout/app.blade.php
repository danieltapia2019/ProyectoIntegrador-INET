<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/app.css">
    <!-- css propios -->
    <link rel="stylesheet" href="@yield('css')">
    <title>@yield('title')</title>
</head>

<body>
    <div class="masterNavBar">
        @include('component.navbar')
    </div>

    @yield('content')

    <div class="masterFooter">
        @include('component.footer')
    </div>
    <script src="js/app.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
