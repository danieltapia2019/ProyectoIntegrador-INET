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
        {{-- <article class="curso">
            <img src="img/cursos.jpg" alt="">
            <h4>"Titulo"</h4>
            <p>Autor</p>
            <p>Precio</p>
            <p>Duracion</p>
        </article>
        <article class="curso">
            <img src="img/cursos.jpg" alt="">
            <h4>"Titulo"</h4>
            <p>Autor</p>
            <p>Precio</p>
            <p>Duracion</p>
        </article>
        <article class="curso">
            <img src="img/cursos.jpg" alt="">
            <h4>"Titulo"</h4>
            <p>Autor</p>
            <p>Precio</p>
            <p>Duracion</p>
        </article>
        <article class="curso">
            <img src="img/cursos.jpg" alt="">
            <h4>"Titulo"</h4>
            <p>Autor</p>
            <p>Precio</p>
            <p>Duracion</p>
        </article> --}}
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
    <h5 class="h2 mb-5">Contacto</h5>
    <form>
        <div class="form-row">
            <form class="" action="index.html" method="POST">
                <div class="datosContacto">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Direccion de email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono"
                            placeholder="Cod.Area-Numero ej. 261-155232343" required>
                    </div>
                </div>
                <div class="col-md-5 mx-4 textArea">
                    <div class="form-group mb-4">
                        <label for="textoarea">Consulta</label>
                        <textarea class="form-control" id="textoarea" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-contact btn-lg btn-block my-3">Enviar</button>
                </div>
            </form>
        </div>
    </form>
</div>

<div id="opiniones">
    <h2 class="mb-5">¿Qué opinan nuestros alumnos?</h2>
    <div class="articuloOpiniones d-flex justify-content-around">
        <div class="card" style="width: 12rem;">
            <div class="card-body">
                <span>
                    <img src="img/alumno1.jpeg" alt="Estudiante" style="width: 5rem;" class="rounded-circle shadow">
                    <h6 class="card-title mt-2">Estudiante</h6>
                </span>
                <p class="card-text">Promunity es una muy buena pagina para aprender programacion desde 0 excelente
                    cursos y
                    la informacion es
                    didactica</p>
            </div>
        </div>
        <div class="card" style="width: 12rem;">
            <div class="card-body">
                <span>
                    <img src="img/alumno2.jpeg" alt="Estudiante" style="width: 5rem;" class="rounded-circle shadow">
                    <h6 class="card-title mt-2">Estudiante</h6>
                </span>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, molestiae
                    accusantium?</p>
            </div>
        </div>
        <div class="card" style="width: 12rem;">
            <div class="card-body">
                <span>
                    <img src="img/alumno3.jpeg" alt="Estudiante" style="width: 5rem;" class="rounded-circle shadow">
                    <h6 class="card-title mt-2">Estudiante</h6>
                </span>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, molestiae
                    accusantium?</p>
            </div>
        </div>
        <div class="card" style="width: 12rem;">
            <div class="card-body">
                <span>
                    <img src="img/alumno4.jpeg" alt="Estudiante" style="width: 5rem;" class="rounded-circle shadow">
                    <h6 class="card-title mt-2">Estudiante</h6>
                </span>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, molestiae
                    accusantium?</p>
            </div>
        </div>
    </div>
</div><!-- /Opiniones -->
<!--Carrusel solo para mobile-->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <article class="border border-secundary border-bottom-0 opinion">
                <span class="h4"><img src="img/alumno1.jpeg" alt="">Estudiante</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in
                    temporibus! Beatae!</p>
            </article>
        </div>
        <div class="carousel-item">
            <article class="border border-secundary border-bottom-0 opinion">
                <span class="h4"><img src="img/alumno2.jpeg" alt="">Estudiante</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in
                    temporibus! Beatae!</p>
            </article>
        </div>
        <div class="carousel-item">
            <article class="border border-secundary border-bottom-0 opinion">
                <span class="h4"><img src="img/alumno3.jpeg" alt="">Estudiante</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in
                    temporibus! Beatae!</p>
            </article>
        </div>
    </div>
</div>
@endsection
