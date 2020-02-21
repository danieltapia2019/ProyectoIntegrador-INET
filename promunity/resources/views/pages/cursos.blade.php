@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/cursos.css') }}">
@endpush

@section('title','Cursos')

@section('content')
<div class="wrapper-curso">
    <div class="curso-filter">
        <a href="cursos.php?dev=programacion" class="prog">Programación</a>
        <a href="cursos.php?dev=videoJueos" class="vj">Videojuegos</a>
        <a href="cursos.php?dev=desarrolloWeb" class="web">Web</a>
        <a href="cursos.php?dev=appMoviles" class="android">Android</a>
    </div>
    <div class="cursos">
        @forelse ($cursos as $curso)
        <article>
            <figure class="img-curso">
                <img src="https://www.anerbarrena.com/wp-content/uploads/2016/04/html5.png" alt="">
            </figure>
            <section class="desc">
                <h2>{{$curso->titulo}}</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi ad voluptate expedita
                    iure? Maxime vel officiis accusantium fuga? Cumque ipsum quas nesciunt modi doloremque enim
                    libero fugit, molestias officia quisquam.</p>
                <p>Lenguaje {{$curso->lenguaje}}</p>
                <footer>
                    @guest
                        <a href="#">Ver Mas</a>
                            
                    @else
                    <a href="#">carrito</a><a href="">favoritos</a>
                    @endguest
                </footer>
            </section>
        </article>
        @empty
        <div>
            <h1>No se encontraron los resultados</h1>
        </div>
        @endforelse
        {{$cursos->links()}}
    </div>
</div>
@endsection
