<?php
$usuarioLogueado=false;
$userA="";
if(isset($_SESSION["usuario"])){
  $usuarioLogueado=true;
  $userA=$_SESSION["usuario"];
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <a class="navbar-brand" href="/<?= basename(dirname(__FILE__))?>/index.php"><img src="/<?= basename(dirname(__FILE__))?>/img/logo.png" alt="" width=60px></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <form class="form-inline my-2 my-lg-0 mx-5 " id="barrabusqueda">
        <input class="form-control mr-sm-2 bg-dark border-0 text-white" type="search" placeholder="Buscar cursos" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 bg-dark border-0" type="submit"><i class="fas fa-search"></i></button>
      </form>
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
      <li class="nav-item mx-3 ">
        <a class="nav-link" href="#">Enseña en Promunity <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
      </li>
      <?php if(!$usuarioLogueado):?>
      <li class="nav-item  mx-5">
        <button class="btn btn-success my-2 my-sm-0  bg-dark border-0" data-toggle="modal" data-target="#modalInicio">Inicia Sesión</i></button>
      </li>
      <li class="nav-item  mx-2">
        <button class="btn btn-success my-2 my-sm-0  bg-ligth border-0" data-toggle="modal" data-target="#modalRegistro">Registrate</button>
      </li>
      <?php endif;?>

      <?php if($usuarioLogueado):?>
      <li class="nav-item dropdown mx-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if(isset($userA["ruta"])):?>
            <span><img src="<?=$userA["ruta"]?>" alt="" class="rounded-circle"></span>
          <?php else:?>
            <span><img src="/<?= basename(dirname(__FILE__))?>/img/perfil.jpg" alt="" class="rounded-circle mx-2"><?=$userA["username"]?></span>
          <?php endif;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/<?= basename(dirname(__FILE__))?>/usuario/perfil1.php">Mi perfil</a>
          <a class="dropdown-item" href="/<?= basename(dirname(__FILE__))?>/index.php?logout=0">Cerrar Sesion</a>
        </div>

      </li>
          <?php endif;?>


    </ul>
  </div>


</nav>
