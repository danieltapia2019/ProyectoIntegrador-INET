@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/cursos.css') }}">
@endpush

@section('title','Cursos')

@section('content')
<div class="wrapper-curso">
    <div class="curso-filter">
        <a href="#" class="prog">Programación</a>
        <a href="#" class="vj">Videojuegos</a>
        <a href="#" class="web">Web</a>
        <a href="#" class="android">Android</a>
    </div>
    <div class="cursos">
        @forelse ($cursos as $curso)
        <article>
            <figure class="img-curso">
                <img src="../img/cursos.jpg" alt="">
            </figure>
            <section class="desc">
                <h2>{{$curso->titulo}}</h2>
                <p>{{$curso->descripcion}}</p>
                <p><b>Lenguaje: </b>{{$curso->lenguaje}}</p>
                <footer>
                    @guest
                    <a href="#" class="">Ver Mas</a>
                    @else
                    <button href="#" class="btn btn-primary mr-1 ml-3"><i class="fas fa-shopping-cart"></i></button>
                    <button href="#" class="btn btn-primary mr-1 "><i class="far fa-heart"></i></button>
                    @endguest
                </footer>
            </section>
        </article>
        @empty
        <div class="empty-result mt-4">
            <h1>No se encontraron resultados para su busqueda</h1>
            <img src="img/mensajes/no-messages.png" alt="Sin resultados">
        </div>
        @endforelse
        {{$cursos->links()}}
    </div>
</div>
@endsection
