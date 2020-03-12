@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/perfil.css') }}">
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
@endpush
@php
use App\User;

$usuario = User::find(auth()->user()->id);
@endphp
@section('title','Perfil')

@section('content')
<header class="bienvenido">
    <div class="usuario" style="background-image: url({{ asset('/img/faqBienvenido.png') }});">
        <!--SideNav-->
        <div id="sideNavigation" class="sidenav">
            <ul style="color: white;">
                @if (auth()->user()->foto == null)
                    <span id="fotoPerfilNav"> <img src="{{ asset('/img/perfil.jpg') }}" alt=""> </span>
                @else
                    <span id="fotoPerfilNav"><img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}" alt="{{auth()->user()->username}}"></span>
                @endif
                <p>STATUS:
                    @if (auth()->user()->acceso == 2)
                    <i class="fas fa-user"></i>
                    @endif
                    @if (auth()->user()->acceso == 1)
                    <i class="fas fa-user-tie"></i>
                    @endif
                    @if (auth()->user()->acceso == 0)
                    <i class="fas fa-users-cog" id="statusIcon"></i>
                    @endif
                </p>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <li>
                    @if (auth()->user()->acceso != 2)
                    <a href="#crearCurso" onclick="abrirDarUnCurso()">
                        <i class="fas fa-folder-plus"></i>
                        Dar un curso
                    </a>
                    @endif
                </li>
                <li>
                    <a href="#PageSetting" onclick="abrirConfig()">
                        <i class="fas fa-cogs"></i>Settings
                    </a>
                </li>
            </ul>
        </div>
        <nav class="topnav">
            <a href="#" onclick="openNav()">
                <i class="fas fa-bars"></i>
                {{-- <ion-icon name="menu" size="large">
                </ion-icon> --}}
            </a>
        </nav>
        <br>
        <h1>Bienvenido a su cuenta {{auth()->user()->username}}</h1>
    </div>
</header>
<div class="tab container" id="UserProfileContent">
    <nav class="row">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-form-tab" data-toggle="tab" href="#tab-perfil" role="tab" aria-controls="tab-perfil" aria-selected="true" onclcick="abrirTab()">Perfil</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tab-cursos" role="tab"
            aria-controls="tab-cursos" aria-selected="false" onclick="abrirTab()">Mis Cursos</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tab-favoritos" role="tab"
            aria-controls="tab-favoritos" aria-selected="false" onclick="abrirTab()">Favoritos</a>
        </div>
    </nav>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active container" id="tab-perfil" role="tabpanel" aria-labelledby="nav-form-tab">
            <!--Configuracion-->
            <div class="configuracion" id="configuracion">
                <form class="actualizacionDatos mb-5" action="/actualizarDatos" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{auth()->user()->id}}">
                  <input type="hidden" name="acceso" value="{{auth()->user()->acceso}}">
                  <input type="hidden" name="estado" value="{{auth()->user()->estado}}">
                    <hr>
                    <label for="username">Nombre de usuario nuevo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control" required value="{{auth()->user()->username}}">
                    </div>
                    <label for="email">Email nuevo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" aria-label="email"
                            value="{{auth()->user()->email}}" required>
                    </div>
                    <label for="password">Contraseña nueva</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control password" aria-label="password"
                            placeholder="Ingrese contraseña" id="password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" name="button" aria-label="password-on"
                            onclick="mostrarContrasena()">
                                <i name="eye" id="ojo" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <label for="password_confirmation">Repetir contraseña nueva</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirmar contraseña">
                    </div>
                    <div class="input-group mb-3">
                        @if (auth()->user()->foto == null)
                            <span id="fotoPerfilNav"> <img src="{{ asset('/img/perfil.jpg') }}" alt=""> </span>
                        @else
                            <span id="fotoPerfilNav"><img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}" alt="{{auth()->user()->username}}"></span>
                        @endif
                      <div class="input-group-prepend">

                        <label for="foto">Cambiar foto</label>
                        <input type="file" name="foto" data-max-size="2048" accept="image/*">
                      </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-success">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
        {{--  --}}
        <div class="tab-pane fade" id="tab-cursos" role="tabpanel" aria-labelledby="pills-cursos-tab">
            <div class="contenedor">
                @forelse ($usuario->cursos as $key => $curso)
                <div class="card-completo">
                    <div class="card-body">
                        <h5 class="card-title">{{$curso->titulo}}</h5>
                        <p class="card-text">{{$curso->descripcion}}</p>
                        <p>Lenguaje: {{$curso->lenguaje}}</p>
                        <p>Precio: {{$curso->precio}}</p>
                        <p>Tipo: {{$curso->tipo->tipoNombre}}</p>
                        <p>Uso: {{$curso->uso->usoNombre}}</p>
                        <a href="/">Ir al curso</a>
                    </div>
                    <img id="foto-curso" src="storage\img\cursos\{{$curso->foto_curso}}" class="card-img" alt="...">
                </div>
                @empty
                <h3>No has comprado ningun curso</h3>
                @endforelse
            </div>
        </div>
        <div class="tab-pane fade" id="tab-favoritos" role="tabpanel" aria-labelledby="pills-contact-tab">

        </div>
    </div>
</div>
<section class="opciones">
    <!--Dar curso-->
    <div class="crear-curso" id="crearCurso" style="display: none;">
        <form class="crearCurso" action="/perfil" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input style="display: none;" type="number" name="autor" value={{auth()->user()->id}}>
            <label for="titulo">Titulo: </label>
            <div class="input-group mb-3">
                <input type="text" name="titulo" class="form-control" placeholder="Ingrese titulo del curso" required
                    maxlength="30" minlength="10">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required></textarea>
            </div>
            <div class="fotoCurso">
                <label for="foto_curso">Foto:</label>
                <input type="file" class="form-control" name="foto_curso" >
            </div>
            <br>
            <label for="precio">Precio:</label>
            <div class="input-group mb-3">
                <input type="number" name="precio" class="form-control" placeholder="Ingrese precio del curso" required
                    maxlength="1" minlength="10">
            </div>
            <label for="lenguaje">Lenguaje: </label>
            <div class="input-group mb-3">
                <input type="text" name="lenguaje" class="form-control" placeholder="Ingrese lenguaje del curso"
                    required maxlength="10" minlength="2">
            </div>

            <label for="tipo" >Tipo: </label>
             <select name="tipo" class="custom-select" id="inputGroupSelect01" required>
                <option selected>Elegir tipo</option>

                @forelse ($tipos as $key => $tipo)
                <option value={{$tipo->id}}>{{$tipo->tipoNombre}}</option>
                @empty
                <option value="">No hay Tipos</option>
                @endforelse
            </select>
            <label for="uso" >Uso: </label>
             <select name="uso" class="custom-select" id="inputGroupSelect01" required>
                <option selected>Elegir uso</option>
                @forelse ($usos as $key => $uso)
                <option value={{$uso->id}}>{{$uso->usoNombre}}</option>
                @empty
                <option value="">No hay Usos</option>
                @endforelse
            </select>
            <br>
            <button type="submit" name="button" class="btn btn-success">Guardar</button>
        </form>
    </div>
</section>
{{-- <section class="config" id="PageSetting">
    <h2 class="">Configuracion de la página</h2>
      <h4 class="mt-5 mb-3"><i class="fas fa-adjust"></i>Dark Mode</h4>
      <form action="" method="POST" class="form-dark">
        <div class="form-check">
          @if( !isset($_COOKIE['UserMode']) )
          <input class="form-check-input" type="checkbox" value="dark" id="darkmode" name="userPreference">
          <label class="form-check-label" for="darkmode">Dark Mode</label>
          @else
          <input class="form-check-input" type="checkbox" value="light" id="lightMode" name="userPreference">
          <label class="form-check-label" for="lightMode">Light Mode</label>
          @endif
        </div>
        <button class="btn btn-outline-primary">Guardar</button>
      </form>
      <p class="text-danger"><strong>*Advertencia</strong>, el 'Modo Oscuro' no ha sido implementado <b>:| *</b></p>
</section> --}}

{{-- <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script> --}}
<script>
window.addEventListener("load", function() {

  // Tu código va acá!
});

</script>

<script type="text/javascript" src="/js/main.js"></script>
@endsection
