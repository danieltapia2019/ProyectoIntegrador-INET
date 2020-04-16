@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush
@section('title','Home')

@section('content')
<section>
    <div id=presentacion>
        <div id=cajanegra>
            <h5>Tomate tu tiempo. Accede a cualquier curso y terminalo cuando quieras. No hay limite de tiempo.</h5>
            <h3>¿Qué estás esperando?</h3>
            <form action="{{ url('/search') }}" method="GET">
                <div class="input-group mb-3 mt-4">
                    <input type="search" id="busquedaSection" class="form-control" placeholder="¿Qué quieres aprender?"
                        aria-label="¿Qué quieres aprender?" aria-describedby="botonbusq" name="q"
                        style="text-align: center">
                    <div class="input-group-append">
                        <button class="btn btn-outline-light" type="submit" id="botonbusq"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div id="iconos">
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
        </div>
    </div>
    <div id="mas-vistos">
        <h2 class="mb-3">Cursos mas visitados</h2>
        @forelse ($cursosFav as $curso)
        <article class="curso">
            <img src="{{ asset('/storage/img/cursos/'.$curso->foto_curso) }}" alt="">
            <h4>{{$curso->titulo}}</h4>
            <p>{{$curso->creador->username}}</p>
            {{-- <p>{{$curso->precio}}</p> --}}
            <p>{{$curso->desc}}</p>
            <p> <a href="/curso/id"> Ver Curso</a> </p>
        </article>
        @empty
        <h4>No hay Favoritos</h4>
        @endforelse
    </div>
</section>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @forelse ($cursosFav as $key => $curso)
        @if ($key == 0)
        <div class="carousel-item active">
            <article class="border border-secundary border-top-0 curso">
                <img src="img/cursos.jpg" alt="">
                <h4>{{$curso->titulo}}</h4>
                <p>{{$curso->creador->username}}</p>
                <p>{{$curso->precio}} ARS</p>
                <p> <a href="/curso/id"> Ver Curso</a> </p>
            </article>
        </div>
        @else
        <div class="carousel-item">
            <article class="border border-secundary border-top-0 curso">
                <img src="img/cursos.jpg" alt="">
                <h4>{{$curso->titulo}}</h4>
                <p>{{$curso->creador->username}}</p>
                <p>{{$curso->precio}} ARS</p>
                <p> <a href="/curso/id"> Ver Curso</a> </p>
            </article>
        </div>
        @endif
        @empty
        <h4>No hay cursos fav</h4>
        @endforelse
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div id="contacto">
    <h5 class="h2 mb-5 ml-5">Contacto</h5>
    <div class="container">
        <form action="{{ url('/anon') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group mr-5">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" >
                    </div>
                    <div class="form-group mr-5">
                        <label for="nombre">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Direccion de email" required>
                    </div>
                    <div class="form-group mr-5">
                        <label for="telefono">Telefono</label>
                        <input name="tel" type="text" class="form-control" id="telefono" placeholder="Cod.Area-Numero ej. 261-155232343" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="textoarea">Consulta</label>
                        <textarea name="consulta" class="form-control" id="textoarea" rows="5" placeholder="Consulta ..." required></textarea>
                    </div>                                        
                </div>
            </div>
            <div class="form-row">
                <div class="col-5"></div>
                <div class="col-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-contact btn-lg btn-block my-3">Enviar</button>
                    </div>                                    
                </div>
                <div class="col-5"></div>
            </div>
        </form>
    </div>
</div>

<div id="opiniones">
    <h2 class="mb-5">¿Qué opinan nuestros usuarios?</h2>
    <div class="articuloOpiniones d-flex justify-content-around">
        @forelse ($usuarios as $key => $usuario)
          <div class="card" style="width: 12rem;">
            <div class="card-body">
              <span>
                <img src="{{$usuario->foto}}" alt="">
                @if ($usuario->acceso == 2)
                  <h6 class="card-title mt-2">Estudiante</h6>
                @elseif($usuario->acceso == 1)
                  <h6 class="card-title mt-2">Profesor</h6>
                @else
                  <h6 class="card-title mt-2">Administrador</h6>
                @endif
              </span>
              <p class="card-text">
                {{$usuario->opinion}}
              </p>
            </div>
          </div>
        @empty
        <h4>No hay usuarios</h4>
      @endforelse
    </div>
</div>
<!-- /Opiniones -->
<!--Carrusel solo para mobile-->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @forelse ($usuarios as $key => $usuario)
        @if ($key==0)
            <div class="carousel-item active">
                <article class="border border-secundary border-bottom-0 opinion">
                    <span class="h4"><img src="{{$usuario->foto}}" alt="">
                      @if ($usuario->acceso == 2)
                        Estudiante
                      @elseif($usuario->acceso == 1)
                        Profesor
                      @else
                        Administrador
                      @endif
                    </span>
                    <p>{{$usuario->opinion}}</p>
                </article>
            </div>
        @else
          <div class="carousel-item">
              <article class="border border-secundary border-bottom-0 opinion">
                  <span class="h4"><img src="{{$usuario->foto}}" alt="">Estudiante</span>
                  <p>{{$usuario->opinion}}</p>
              </article>
          </div>
        @endif
      @empty
        <h4>No hay usuarios</h4>
      @endforelse
    </div>
</div>
@endsection