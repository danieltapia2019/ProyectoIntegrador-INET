<?php

include("../rutas.php");
include("../data/usuario.php");
include ("../data/conexion.php");
session_start();
if(!isset($_SESSION["usuario"])) {
    header('Location:'.$BASE_URL.'/index.php');
}
$id = $_SESSION["usuario"]->getId();
if($_SESSION["usuario"]->getAcceso() == 2){
  $consulta = "SELECT curso.id, curso.titulo ,curso.lenguaje,curso.foto_curso FROM usuario_curso,curso WHERE usuario_curso.id_usuario = '$id' AND usuario_curso.id_curso = curso.id";

}else{
  $consulta = "SELECT curso.id, curso.titulo ,curso.lenguaje,curso.foto_curso FROM curso  WHERE curso.autor = '$id'";
}

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
  <link rel="stylesheet" href="../css/perfil1.css">
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
        <?php if($_SESSION["usuario"]->getAcceso() < 2): ?>
      <a href="#">
        <ion-icon name="add-circle"></ion-icon>
        Dar un curso</a>
      <?php endif; ?>
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
        <div class="mis-cursos" id="misCursos" style="display: none;">
          <?php foreach($conexion->query($consulta) as $row){ ?>
            <article class="border border-secundary border-top-0 curso">
            <div class="card" style="width: 18rem;">
              <img src="<?=$BASE_URL."/img/fotoCurso/".$row['foto_curso']?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?=$row['titulo']?></h5>
                <p>Lenguaje: <?=$row['lenguaje']?></p>
                <?php if($_SESSION["usuario"]->getAcceso() == 1): ?>
                <h6>Alumnos: </h6>
                <a href="#" class="btn btn-primary">Borrar Curso</a>
                <?php endif; ?>
              </div>
              <p syle="display:none">id <?=$row['id']?></p>
              <a href="perfil1.php?id=<?=$row['id']?>">Ir al curso</a>
            </div>

            </article>
        <?php }  ?>
        </div>
        <!--Dar curso-->
        <div class="crear-curso" id="crearCurso" style="display: none;">
          <form class="" action="perfil1.php" method="post">

          </form>

        </div>
        <!--Favoritos-->
                <!--Configuracion-->
              <div class="configuracion" id="configuracion">
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

    <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="funcionesPerfil.js"></script>
</body>
</html>
