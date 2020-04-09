@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/faq.css') }}">
@endpush

@section('title','F.A.Q')

@section('content')

<header class="header">
    <div class="usuario">
        <br>
        <h1>Hola ¿Necesitas ayuda?</h1>
    </div>
</header>

<section class="seccion">
    <div class="duda">
        <ul style="list-style : none;">
            <li>
              <a href="#sesion">Registrarse y Login</a>
            </li>
            <li>
                <a href="#curso">Inscribirse a un curso</a>
            </li>
            <li>
                <a href="#subir">Subir un curso</a>
            </li>
            <li>
                <a href="#clases">¿Como son las clases?</a>
            </li>
            <li>
                <a href="#pago">Metodos de pago</a>
            </li>
            <li>
                <a href="#">Reportar un problema</a>
            </li>
        </ul>
    </div>
    <div class="contenido">
        <h4>Todo lo que necesitas saber para usar Promunity</h4>
        <article class="" id="sesion">
            <h5>Registrarse y Login</h5>
            <ul style="list-style: none;">
                <li>
                    <a href="#" class="registarse">Registrarse</a>
                    <div class="register">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                </li>
                <li>
                    <a href="#">Login</a>
                </li>
            </ul>
        </article>

        <article class="" id="curso">
            <h5>Inscribirse a un curso</h5>
            <ul style="list-style: none;">
                <li>
                    <a href="#">Inscribirse online</a>
                </li>
            </ul>
        </article>

        <article class="" id="subir">
            <h5>Subir un curso a Promunity</h5>
            <ul style="list-style: none;">
                <li>
                    <a href="#">Curso presencial</a>
                </li>
                <li>
                    <a href="">Curso presencial</a>
                </li>
            </ul>
        </article>

        <article class="" id="clases">
            <h5>Clases en Promunity</h5>
            <ul style="list-style: none;">
                <li>
                    <a href="#">Clases presenciales</a>
                </li>
                <li>
                    <a href="">Clases online</a>
                </li>
            </ul>
        </article>

        <article class="" id="pago">
            <h5>Metodos de pago</h5>
            <ul style="list-style: none;">
                <li>
                    <a href="#">Registrarse</a>
                </li>
                <li>
                    <a href="">Login</a>
                </li>
            </ul>
        </article>

    </div>
</section>
@endsection
