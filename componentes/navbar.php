<?php
if(file_exists('rutas.php')){
  include_once('rutas.php');
}
elseif (file_exists(__DIR__."/../rutas.php")) {
  include_once(__DIR__."/../rutas.php");
}

$usuarioLogueado=false;
$userA="";
$fotoPerfil = "no";
if(isset($_SESSION["usuario"])){
  $usuarioLogueado=true;
  $userA=$_SESSION["usuario"];
}
if($_SESSION){
if(count($_SESSION) > 0){
if($_SESSION["usuario"]->getFoto() != null){
  $fotoPerfil =  $_SESSION["usuario"]->getFoto();
}
  }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <a class="navbar-brand" href="<?=$BASE_URL?>/index.php"><img src="<?=$BASE_URL?>/img/logo.png" alt="" width=60px></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline" id="barrabusqueda">
          <input class="form-control mr-sm-2 bg-dark border-0 text-white barra" type="search" placeholder="Buscar cursos" aria-label="Search">
          <button class="btn btn-sm btn-outline-success my-2 my-sm-0 bg-dark border-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown mx-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-th-list"></i>
          Cursos disponibles
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Lenguajes de Programacion</a>
          <a class="dropdown-item" href="#">Desarrollo de Videojuegos</a>
          <a class="dropdown-item" href="#">Desarrollo Web</a>
          <a class="dropdown-item" href="#">Aplicaciones Moviles</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Mas cursos...</a>
        </div>
      </li>
      <li class="nav-item mx-3 ensenia">
        <a class="nav-link" href="#">Enseña en Promunity <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mx-3 carrito">
        <a class="nav-link carritoLink" href="#"><i class="fas fa-shopping-cart"></i></a>
      </li>
      <?php if(!$usuarioLogueado):?>
      <li class="nav-item  mx-5 login">
        <button class="btn btn-success my-2 my-sm-0  bg-dark border-0" data-toggle="modal" data-target="#modalInicio">Inicia Sesión</i></button>
      </li>
      <li class="nav-item  mx-2 register">
        <button class="btn btn-success my-2 my-sm-0  bg-ligth border-0 register" data-toggle="modal" data-target="#modalRegistro">Registrate</button>
      </li>
      <?php endif;?>

      <?php if($usuarioLogueado):?>
      <li class="nav-item dropdown mx-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if($fotoPerfil != "no"):?>
            <span id="fotoPerfil"><img style="border-radius: 100%;" src="<?=$BASE_URL."/img/fotoPerfil/".$fotoPerfil?>" class="rounded-circle mx-2"><?=$userA->getUserName()?></span>
          <?php else:?>
            <span id="imagenNombre"><img src="<?=$BASE_URL?>/img/perfil.jpg" alt="" class="rounded-circle mx-2"><?=$userA->getUserName()?></span>
          <?php endif;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?=$BASE_URL?>/usuario/perfil1.php">Mi perfil</a>
          <?php if($userA->getAcceso() == 0): ?>
          <a class="dropdown-item" href="<?=$BASE_URL?>/abm.php">Ir al ABM</a>
          <?php endif;?>
          <a class="dropdown-item" href="<?=$BASE_URL?>/index.php?logout=0">Cerrar Sesion</a>
        </div>

      </li>
          <?php endif;?>


    </ul>
  </div>
  <!-- Modal Registro-->
  <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bienvenido a Promunity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" action="<?=$BASE_URL?>/operaciones/registrar.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="username" class="form-control" aria-label="text" placeholder="Nombre de usuario" required maxlength="25" minlength="5">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
              </div>
              <input type="email" name="email" class="form-control" aria-label="email" placeholder="Ingrese email" required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" id="passwordRegister" maxlength="20" minlength="6" required>
              <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()">
                  <ion-icon name="eye" id="ojoRegister"></ion-icon>
              </button>

            </div>
              <div id="imagenNombre">

                        <div class="input-group mb-3">
                              <img src="<?=$BASE_URL?>/img/perfil.jpg" alt="" id="imgNormal">
                                <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;" >
                                      <div class="custom-file">
                                <input name="fotoPerfil" type="file" class="custom-file-input" id="seleccionArchivos" accept="image/*" data-max-size="2048">
                                <label accept="image/* "class="custom-file-label" for="inputGroupFile01">Foto</label>
                                              </div>
                                    </div>
                                            <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                                                    <script >const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
                                                   $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

                                                 // Escuchar cuando cambie
                                                 $seleccionArchivos.addEventListener("change", () => {
                                                   imagenNormal = document.getElementById('imgNormal').style.display="none";
                                                   imagenElegida = document.getElementById('imagenPrevisualizacion').style.display="inherit";
                                                   // Los archivos seleccionados, pueden ser muchos o uno
                                                   const archivos = $seleccionArchivos.files;
                                                 // Si no hay archivos salimos de la función y quitamos la imagen
                                                 if (!archivos || !archivos.length) {
                                                   $imagenPrevisualizacion.src = "";
                                                   imagenNormal = document.getElementById('imgNormal').style.display="inherit";
                                                   imagenElegida = document.getElementById('imagenPrevisualizacion').style.display="none";
                                                   return;
                                                 }
                                                 // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                                                 const primerArchivo = archivos[0];
                                                 // Lo convertimos a un objeto de tipo objectURL
                                                 const objectURL = URL.createObjectURL(primerArchivo);
                                                 // Y a la fuente de la imagen le ponemos el objectURL
                                                 $imagenPrevisualizacion.src = objectURL;
                                               });</script>
                                            </div>
            <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Registrarse</button>
          </form>

          <p class="h6 text-center">Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
          <div class="">
          <hr>
          </div>
          <p class="h6 text-center">¿Ya tienes una cuenta?
              <button class="btn btn-success my-2 my-sm-0  bg-dark border-0 login" data-toggle="modal" data-target="#modalInicio" id="button" onclick="cerrarModalActivo()">Inicia Sesión</i></button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Inicio-->
  <div class="modal fade" id="modalInicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bienvenido! Inicia Sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?=$BASE_URL?>/operaciones/loguear.php" method="post">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
            </div>
            <input type="email" name="email" class="form-control" aria-label="email" placeholder="Ingrese email" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" id="password" maxlength="20" minlength="6" required>
            <button type="button" class="btn btn-primary" name="button" onclick="mostrarContrasena()">
                <ion-icon name="eye" id="ojoOn"></ion-icon>
            </button>
          </div>
          <p>
          <input type="checkbox" name="" value=""> Recordarme</p>
          <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Iniciar Sesión</button>
        </form>
          <p class="text-center"> <a href="#" >¿Has olvidado tu contraseña?</a></p>
          <p class="text-center mt-3">¿No tienes cuenta?
            <button class="btn btn-success my-2 my-sm-0  bg-ligth border-0 register" data-toggle="modal" data-target="#modalRegistro" onclick="cerrarModalActivo()"  id="button" >Registrate</button>
        </p>
        </div>





      </div>

    </div>

  </div>
<script>
function mostrarContrasena(){

    var tipoLogin = document.getElementById("password");
    var ojoLogin = document.getElementById("ojoOn");
    var modalInicio = $("#modalInicio").is(":visible");
    var tipoRegister = document.getElementById("passwordRegister");
    var ojoRegister = document.getElementById("ojoRegister");
    if(modalInicio){//si el modal inicio esta activo
    if(tipoLogin.type == "password"){
        tipoLogin.type = "text";
        ojoLogin.name = "eye-off";
    }else{
        tipoLogin.type = "password";
        ojoLogin.name = "eye";
    }
  }else{//si el modal register esta activo

    if(tipoRegister.type == "password"){
        tipoRegister.type = "text";
        ojoRegister.name = "eye-off";
    }else{
        tipoRegister.type = "password";
        ojoRegister.name = "eye";
    }
  }
}
function cerrarModalActivo() {
  var modalInicio = $("#modalInicio").is(":visible");
  if(modalInicio){
    $('#modalInicio').modal('hide');
  }else{
      $('#modalRegistro').modal('hide');
  }
}

</script>





</nav>
