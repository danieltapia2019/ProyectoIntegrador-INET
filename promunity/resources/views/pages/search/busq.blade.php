@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/cursos.css') }}">
@endpush

@section('title','Cursos')

@section('content')
<div class="container wrapper-curso">
    <div class="row curso-search">
        <form action="{{ url('/search') }}" class="col-12 mt-5 mb-5" method="GET" id="filtForm">
            <div class="form-row">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input type="search" id="busquedaSection" class="form-control" placeholder="buscar" aria-describedby="btnSearch" name="q" value="{{$query}}" style="text-align: center">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light " id="btnSearch" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12">
                    <button class="btn btn-default-outline filt" type="button" id="filter"><i class="fas fa-filter"></i>Filtrar</button>
                </div>
            </div>

        </form>
    </div>
    <div class="cursos">
        @forelse ($cursos as $curso)
        <article>
            <figure class="img-curso">
                <img src="..\storage\img\cursos\{{$curso->foto_curso}}" alt="notFoundImage">
            </figure>
            <section class="desc">
                <h2>{{$curso->titulo}}</h2>
                <p><b>Lenguaje: </b>{{$curso->lenguaje->nombreLenguaje}}</p>
                <p><b>Fecha: </b>{{$curso->created_at}}</p>
                <footer>
                    @guest
                    <a href="{{ url("/curso/$curso->id") }}">Ver Mas</a>
                    @else
                    <a href="{{ url("/curso/$curso->id") }}">Ver Mas</a>
                    <button class="btn btn-primary mr-1" style="margin-left: 75%;">
                        <a href="{{ url('/carrito'.'/'.$curso->id) }}" style="color: white">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </button>
                    @endguest
                </footer>
            </section>
        </article>
        @empty
        <div class="empty-result mt-4">
            <h1>No se encontraron resultados para su busqueda</h1>
            <img src="{{ asset('img/mensajes/no-messages.png')}}" alt="Sin resultados">
        </div>
        @endforelse
        {{$cursos->links()}}
    </div>
</div>

@endsection

@section('scripting')
{{-- No Borrar comentario de abajo --}}
{{-- <script type="text/javascript" src="{{ asset('js/search.js') }}"></script> --}}
<script>
    document.querySelector('button#filter').addEventListener('click',()=>{
        window.location = "http://localhost:8000/search/filter?q=&tip=all&uso=all&lng=all&ord=all&state=0&setTime=n"
    });
</script>
@endsection
