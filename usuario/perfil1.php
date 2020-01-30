<?php

include("../rutas.php");
include("../data/usuario.php");
include ("../data/conexion.php");
session_start();
$misCursosAlumno = "SELECT INTO";
if(!isset($_SESSION["usuario"])) {
    header('Location:'.$BASE_URL.'/index.php');
}
$UsuarioID = $_SESSION["usuario"]->getId();
if($_SESSION["usuario"]->getAcceso() == 1){
  $consulta = "SELECT curso.id, curso.curso_lenguaje , curso.curso_nombre, curso.curso_foto FROM alumno_curso,curso WHERE alumno_curso.alumno_id = '$UsuarioID' AND alumno_curso.curso_id = curso.id";
}else{
  $consulta = "SELECT curso.id,curso.curso_lenguaje,curso.curso_nombre,curso.curso_foto  FROM curso  WHERE curso.curso_autor = '$UsuarioID'";
}

$resultado = mysqli_query($conexion,$consulta);
if(count($_SESSION) > 0){
if($_SESSION["usuario"]->getFoto() != null){
  $fotoPerfil  =  $_SESSION["usuario"]->getFoto();
}
else {
  $fotoPerfil = "no";
}
}

$userName = "";
$userEmail = "";
if(isset($_SESSION)){
  if(sizeof($_SESSION) !=0){
  $userName = $_SESSION["usuario"]->getUserName();
  $userEmail = $_SESSION["usuario"]->getEmail();
}
  else {
    $userName = "";
  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$userName?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/stylePrincipal.css">
  <link rel="stylesheet" href="perfilStyle.css">
  <link rel="shortcut icon" href="../img/logo.png" />
</head>
<body>
    <!--Navbar-->

    <?php include("../componentes/navbar.php");?>
    <!--Header-->
      <header class = "bienvenido">
        <div class="usuario">

          <!--SideNav-->
          <div id="sideNavigation" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="#" onclick="abrirMisCursos()">
        <ion-icon name="briefcase"></ion-icon>
        Mis cursos</a>
        <?php if($_SESSION["usuario"]->getAcceso() >=2): ?>
      <a href="#">
        <ion-icon name="add-circle"></ion-icon>
        Dar un curso</a>
      <?php endif; ?>
      <a href="#">
        <ion-icon name="star"></ion-icon>
        Favoritos</a>
      <a href="#" onclick="abrirConfiguracion()">
        <ion-icon name="build"></ion-icon>
        Configuracion</a>
    </div>

    <nav class="topnav">
      <a href="#" onclick="openNav()">
        <ion-icon name="menu" size="large">
        </ion-icon>
      </a>
    </nav>
          <br>
            <h1 >Bienvenido a su cuenta <?=$userName?>
              </h1>
        </div>
      </header>
      <section class="opciones">
        <!--Mis cursos-->
        <div class="mis-cursos" id="misCursos">
          <h1> Usted Esta en Mis cursos</h1>
          <?php while($fila = mysqli_fetch_row($resultado)){ ?>
            <article class="border border-secundary border-top-0 curso">

            <div class="card" style="width: 18rem;">
              <img src="<?=$BASE_URL."/img/fotoCurso/".$fila[3]?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?=$fila[2]?></h5>
                <p>Lenguaje: <?=$fila[1]?></p>
                <?php if($_SESSION["usuario"]->getAcceso() < 1): ?>
                <h6>Alumnos: </h6>
                <a href="#" class="btn btn-primary">Borrar Curso</a>
                <?php endif; ?>
              </div>
            </div>
            </article>
        <?php }  ?>
        </div>
        <!--Dar curso-->
        <div class="crear-curso" id="crearCurso">
          <form class="" action="perfil1.php" method="post">
            
          </form>

        </div>
        <!--Favoritos-->
                <!--Configuracion-->
              <div class="configuracion" style="display: none;" id="configuracion">
                            <form class="" action="perfil1.php" method="post">

                                <div id="imagenNombre">

                                      <div class="input-group mb-3">
                                        <?php if($fotoPerfil == "no"): ?>
                                          <img src="<?=$BASE_URL?>/img/perfil.jpg" alt="" id="imgNormal">
                                        <?php else: ?>
                                          <img src="<?=$BASE_URL?>/img/fotoPerfil/<?=$fotoPerfil?>" alt="" class="rounded-circle mx-2" id="imgNormal"></span>
                                        <?php endif; ?>
                                          <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;" >
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="seleccionArchivos" required>
                                          <label accept="image/* "class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
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
                                <button class="btn btn-success btn-sm" type="submit" name="button">
                                  Guardar foto
                                </button>

                            </form>
                            <form class="" action="" method="post">
                              <hr>
                              <div class="form-group">
                          <label for="exampleInputEmail1">Cambiar Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"
                          value=<?=$userEmail?>>
                        </div>
                          <hr>
                          <label for="password">Contraseña actual</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" id="passwordRegister" required>
                          <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()" >
                              <ion-icon name="eye" id="ojoRegister"></ion-icon>
                          </button>

                        </div>
                        <hr>
                        <label for="password">Contraseña nueva</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" id="passwordRegister">
                          <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()" required>
                              <ion-icon name="eye" id="ojoRegister"></ion-icon>
                          </button>

                        </div>

                    <button type="submit" name="button" class="btn btn-success">
                      Guardar Cambios
                    </button>
                  </form>
                </div>
                        </div>

      </section>

    <!--Footer-->
    <?php include("../componentes/footer.php") ?>

        <!--Script-->
    <script>

    function mostrarContrasena(){
      var tipoLogin = document.getElementById("password");
      var ojoLogin = document.getElementById("ojoOn");
      var tipoRegister = document.getElementById("passwordRegister");
      var ojoRegister = document.getElementById("ojoRegister");
      if(tipoLogin.type == "password"){
          tipoLogin.type = "text";
          ojoLogin.name = "eye-off";
      }else{
          tipoLogin.type = "password";
          ojoLogin.name = "eye";
      }
      if(tipoRegister.type == "password"){
          tipoRegister.type = "text";
          ojoRegister.name = "eye-off";
      }else{
          tipoRegister.type = "password";
          ojoRegister.name = "eye";
      }
    }


    function abrirFavoritos(){
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById('configuracion').style.display = "none";

     }
     function abrirMisCursos(){
       document.getElementById("sideNavigation").style.width = "0";
       document.getElementById('configuracion').style.display = "none";
       document.getElementById("misCursos").style.display = "inherit";
     }

    function abrirConfiguracion(){
      document.getElementById("sideNavigation").style.width = "0";
      document.getElementById("misCursos").style.display = "none";
      document.getElementById('configuracion').style.display = "inherit";
    }
    function openNav() {
    document.getElementById("sideNavigation").style.width = "200px";
    }

    function closeNav() {
    document.getElementById("sideNavigation").style.width = "0";
    }
</script>
    <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
