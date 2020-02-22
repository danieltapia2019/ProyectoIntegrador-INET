@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/perfil.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endpush
@section('title','Perfil')

@section('content')
<header class="bienvenido">
    <div class="usuario" style="background-image: url({{ asset('/img/faqBienvenido.png') }});">
        <!--SideNav-->
        <div id="sideNavigation" class="sidenav">
          <div style="color: white;">
            @if (auth()->user()->foto == null)
              <span id="fotoPerfilNav"> <img src="{{ asset('img/perfil.jpg') }}" alt=""> </span>
            @else
              <span id="fotoPerfilNav"></span>
            @endif
            <p>STATUS:
              @if (auth()->user()->acceso == 2)
                <i class="fas fa-user-graduate" id="statusIcon"></i>
                <p>Alumno</p>
              @endif
              @if (auth()->user()->acceso == 1)
                <i class="fas fa-chalkboard-teacher" id="statusIcon"></i>
                <p>Profesor</p>
              @endif
              @if (auth()->user()->acceso == 0)
                <i class="fas fa-users-cog" id="statusIcon"></i>
                <p>Administrador</p>
              @endif
            </p>
          </div>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            @if (auth()->user()->acceso != 2)
            <a href="#crearCurso" onclick="abrirDarUnCurso()">
                <ion-icon name="add-circle"></ion-icon>
                Dar un curso
            </a>
           @endif
        </div>

        <nav class="topnav">
            <a href="#" onclick="openNav()">
                <ion-icon name="menu" size="large">
                </ion-icon>
            </a>
        </nav>
        <br>
        <h1>Bienvenido a su cuenta {{auth()->user()->username}}
        </h1>
    </div>
</header>
<div class="tab">
<div class="row">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#tab-perfil" role="tab" aria-controls="tab-perfil" aria-selected="true" onclcick="abrirTab()">Perfil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tab-cursos" role="tab" aria-controls="tab-cursos" aria-selected="false" onclick="abrirTab()">Mis Cursos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab-favoritos" role="tab" aria-controls="tab-favoritos" aria-selected="false" onclick="abrirTab()">Favoritos</a>
    </li>
  </ul>
</div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="tab-perfil" role="tabpanel" aria-labelledby="pills-home-tab">
    <!--Configuracion-->
    <div class="configuracion" id="configuracion">
        <form class="" action="perfil1.php" method="post" enctype="multipart/form-data">

            <div id="imagenNombre">

                <div class="input-group mb-3">
                    <?php //if($fotoPerfil == "no"): ?>
                    <img src="<?php //echo $BASE_URL?>/img/perfil.jpg" alt="" id="imgNormal">
                    <?php //else: ?>
                    <img src="<?php //echo $BASE_URL?>/img/fotoPerfil/<?php //echo $fotoPerfil?>" alt=""
                        class="rounded-circle mx-2" id="imgNormal"></span>
                    <?php //endif; ?>
                    <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="seleccionArchivos" required>
                        <label accept="image/* " class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
                    </div>
                </div>

                <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                <script>
                    const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
                        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

                    // Escuchar cuando cambie
                    $seleccionArchivos.addEventListener("change", () => {
                        imagenNormal = document.getElementById('imgNormal').style.display = "none";
                        imagenElegida = document.getElementById('imagenPrevisualizacion').style.display =
                            "inherit";
                        // Los archivos seleccionados, pueden ser muchos o uno
                        const archivos = $seleccionArchivos.files;
                        // Si no hay archivos salimos de la función y quitamos la imagen
                        if (!archivos || !archivos.length) {
                            $imagenPrevisualizacion.src = "";
                            imagenNormal = document.getElementById('imgNormal').style.display = "inherit";
                            imagenElegida = document.getElementById('imagenPrevisualizacion').style.display =
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
        <form class="actualizacionDatos" action="" method="post">
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
                <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()" required>
                    <ion-icon name="eye" id="ojoRegister"></ion-icon>
                </button>

            </div>
            <button type="submit" name="button" class="btn btn-success">
                Guardar Cambios
            </button>
        </form>
    </div></div>
    <div class="tab-pane fade" id="tab-cursos" role="tabpanel" aria-labelledby="pills-cursos-tab">
     MIS cursos
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
            <input type="text" name="titulo" class="form-control" placeholder="Ingrese titulo del curso" required maxlength="30" minlength="10">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion:</label>
          <textarea  name="descripcion" class="form-control" id="descripcion" rows="3" required></textarea>
        </div>
        <div class="fotoCurso">

          <label for="foto_curso">Foto:</label>
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <input type="file" class="form-control" name="imagen" id="imagen" maxlength="256" placeholder="Imagen">
  <input type="hidden" class="form-control" name="foto_curso" id="imagenactual">
  <div class="imagenPrev">
    <img clas="rounded mx-auto d-block" src="" id="imagenmuestra">
  </div>
  <script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      // Asignamos el atributo src a la tag de imagen
      $('#imagenmuestra').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
  }

  // El listener va asignado al input
  $("#imagen").change(function() {
  readURL(this);
  });
  </script>
        </div>
<br>
        <label for="precio">Precio:</label>
        <div class="input-group mb-3">
          <input type="number" name="precio" class="form-control" placeholder="Ingrese precio del curso" required maxlength="1" minlength="10">
        </div>
          <label for="lenguaje">Lenguaje: </label>
          <div class="input-group mb-3">
            <input type="text" name="lenguaje" class="form-control" placeholder="Ingrese lenguaje del curso" required maxlength="10" minlength="2">
          </div>
          <label for="categoria">Categoria: </label>
          <select name="categoria" class="custom-select" id="inputGroupSelect01">
            <option selected>Elegir categoria</option>
          </select>
          <br>
          <button type="submit" name="button" class="btn btn-success">Guardar</button>
      </form>
    </div>
</section>

<script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script>
    function abrirDarUnCurso() {
        closeNav();
        document.getElementById('pills-tabContent').style.display = "none";
        document.getElementById("crearCurso").style.display = "inherit";
    }
    function abrirTab(){
          document.getElementById('crearCurso').style.display = "none";
          document.getElementById('pills-tabContent').style.display = "inherit";
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
