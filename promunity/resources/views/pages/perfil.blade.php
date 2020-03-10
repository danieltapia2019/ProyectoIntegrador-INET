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
                    <span id="fotoPerfilNav"><img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}" alt="{{auth()->user()->username}}"</span>
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
                <form class="" action="perfil1.php" method="post" enctype="multipart/form-data">

                    <div id="imagenNombre">

                        <div class="input-group mb-3">
                            <img src="/img/perfil.jpg" alt="" id="imgNormal">
                            <img src="/img/fotoPerfil/" alt=""
                                class="rounded-circle mx-2" id="imgNormal"></span>
                            <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="seleccionArchivos" required>
                                <label accept="image/* " class="custom-file-label" for="inputGroupFile01">Elegir
                                    archivo</label>
                            </div>
                        </div>

                        <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                        <script>
                            const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
                                $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

                            // Escuchar cuando cambie
                            $seleccionArchivos.addEventListener("change", () => {
                                imagenNormal = document.getElementById('imgNormal').style.display = "none";
                                imagenElegida = document.getElementById('imagenPrevisualizacion').style
                                    .display =
                                    "inherit";
                                // Los archivos seleccionados, pueden ser muchos o uno
                                const archivos = $seleccionArchivos.files;
                                // Si no hay archivos salimos de la función y quitamos la imagen
                                if (!archivos || !archivos.length) {
                                    $imagenPrevisualizacion.src = "";
                                    imagenNormal = document.getElementById('imgNormal').style.display =
                                        "inherit";
                                    imagenElegida = document.getElementById('imagenPrevisualizacion').style
                                        .display =
                                        "none";
                                    return;
                                }
                                // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                                const primerArchivo = archivos[0];
                                // Lo convertimos a un objeto de tipo objectURL
                                const objectURL = URL.createObjectURL(primerArchivo);
                                // Y a la fuente de la imagen le ponemos el objectURL
                                $imagenPrevisualizacion.src = objectURL;
                            });

                        </script>
                    </div>
                    <button class="btn btn-success btn-sm" type="submit" name="button">
                        Guardar foto
                    </button>

                </form>
                <form class="actualizacionDatos mb-5" action="" method="post">
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cambiar Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" value={{auth()->user()->email}}>
                    </div>
                    <hr>
                    <label for="password">Contraseña actual</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" aria-label="password"
                            placeholder="Ingrese contraseña" id="passwordRegister" required>
                        <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()">
                            <ion-icon name="eye" id="ojoRegister"></ion-icon>
                        </button>

                    </div>
                    <hr>
                    <label for="password">Contraseña nueva</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" aria-label="password"
                            placeholder="Ingrese contraseña" id="passwordRegister">
                        <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()"
                            required>
                            <ion-icon name="eye" id="ojoRegister"></ion-icon>
                        </button>

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
    function abrirDarUnCurso() {
        closeNav();
        document.getElementById('UserProfileContent').style.display = "none";
        document.getElementById("crearCurso").style.display = "inherit";
    }
    function abrirTab() {
        document.getElementById('crearCurso').style.display = "none";
        document.getElementById('PageSetting').style.display = "none";
        document.getElementById('UserProfileContent').style.display = "inherit";
    }

    function openNav() {
        document.getElementById("sideNavigation").style.width = "200px";
    }

    function closeNav() {
        document.getElementById("sideNavigation").style.width = "0";
    }

    function mostrarContrasena() {
        var tipoLogin = document.getElementById("password");
        var ojoLogin = document.getElementById("ojoOn");
        var tipoRegister = document.getElementById("passwordRegister");
        var ojoRegister = document.getElementById("ojoRegister");
        if (tipoLogin.type == "password") {
            tipoLogin.type = "text";
            ojoLogin.name = "eye-off";
        } else {
            tipoLogin.type = "password";
            ojoLogin.name = "eye";
        }
        if (tipoRegister.type == "password") {
            tipoRegister.type = "text";
            ojoRegister.name = "eye-off";
        } else {
            tipoRegister.type = "password";
            ojoRegister.name = "eye";
        }
    }

</script>
@endsection
