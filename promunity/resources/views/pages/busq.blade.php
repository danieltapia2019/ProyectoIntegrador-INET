@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/cursos.css') }}">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
@endpush

@section('title','Cursos')

@section('content')
<div class="container wrapper-curso">
    <div class="row curso-search">
        <form action="{{ url('/search') }}" class="col-12 mt-5 mb-5" method="GET" id="filtForm">
            <div class="form-row">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input type="search" id="busquedaSection" class="form-control" placeholder="buscar" aria-describedby="botonbusq" name="q" value="{{$query}}" style="text-align: center">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light " id="botonBusq" type="button" onclick="filterSearch()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12">
                    <button class="btn btn-default-outline filt" onclick="ocultar()" type="button"><i class="fas fa-filter"></i>filtrar</button>
                </div>
            </div>

            <div class="form-row mt-3 filt-form" hidden>
                <div class="form-group col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="tipo">Tipo</label>
                        </div>
                        <select class="custom-select" id="tipo" name="tip">
                            <option  value="all" selected>todos</option>
                            @forelse ($tipos as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->tipoNombre}}</option>
                            @empty
                            <option value="all" selected>todos</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="uso">Uso</label>
                        </div>
                        <select class="custom-select" id="uso" name="uso">
                            <option value="all" selected>todos</option>
                            @forelse ($usos as $uso)
                            <option value="{{$uso->id}}">{{$uso->usoNombre}}</option>
                            @empty
                            <option value="all" selected>todos</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="orden">Ordenar por</label>
                        </div>
                        <select class="custom-select" id="orden" name="ord">
                            <option value="all" selected>Todos</option>
                            <option value="new">Más nuevos</option>
                            <option value="old">Más viejos</option>
                        </select>
                    </div>
                </div> --}}
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
                <p>{{$curso->descripcion}}</p>
                <p><b>Lenguaje: </b>{{$curso->lenguaje}}</p>
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
                    {{-- <button class="btn btn-primary mr-1 ">
                        <a href="#" style="color: white"><i class="far fa-heart"></i></a>
                    </button> --}}
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
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
