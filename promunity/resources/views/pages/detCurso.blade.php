{{-- Detalle Curso --}}
@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/detCurso.css') }}">
@endpush
@section('title',$cursoSelect->titulo)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div id="detalleCurso" class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
            {{-- <h1>Content detalleCurso</h1> --}}
            <article class="row ">
                <figure class="img-curso col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    <img src="..\storage\img\cursos\{{$cursoSelect->foto_curso}}" alt="notFoundImage">
                </figure>
                <section class="desc col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <h2>{{$cursoSelect->titulo}}</h2>
                    <p>{{$cursoSelect->descripcion}}</p>
                    <p><b>Lenguaje: </b>{{$cursoSelect->lenguaje->nombreLenguaje}}</p>
                    <p><b>Precio: </b>{{$cursoSelect->precio}}</p>
                    <p><b>Duracion: </b>{{$cursoSelect->duracion}}</p>
                </section>
                <section class="col-xl-8 col-lg-9 col-md-8 col-sm-12">
                    <p>{{$cursoSelect->desc}}</p>
                </section>
                <footer class="col-xl-8 col-lg-9 col-md-8 col-sm-12">
                    @guest
                    <p>Para comprar el curso debes estar <a href="{{ url("/register") }}">registrado</a></p>
                    @else
                    <button class="btn btn-primary mr-1 ml-3">
                        <a href="{{ url('/carrito'.'/'.$cursoSelect->id) }}" style="color: white">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </button>
                    @endguest
                </footer>
            </article>
        </div>
        <div id="recomend-wrapper" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
            <h2 class="text-center">Cursos recomendados</h2>
            <div id="recomend" class="d-flex flex-column justify-content-center">
            @forelse ($cursosRecom as $cursoRecom)
            <div class="card mt-5">
                <img src="..\storage\img\cursos\{{$cursoRecom->foto_curso}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <b><p class="card-text">{{$cursoRecom->titulo}}</p></b>
                    <b><a href="{{ url("/curso/$cursoRecom->id") }}">ver más</a></b>
                </div>
            </div>
            @empty
                <h1>Sin recomendaciones</h1>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
