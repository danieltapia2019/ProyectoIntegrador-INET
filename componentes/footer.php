<?php
  if(file_exists('rutas.php')){
    include_once('rutas.php');
  }
  elseif (file_exists(__DIR__."/../rutas.php")) {
    include_once(__DIR__."/../rutas.php");
  }
?>
<footer class="footer">
  <div class="lista">
    <ul>
        <h5>Navegación</h5>
      <li><a href="<?=$BASE_URL?>/index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
      <li><a href="<?=$BASE_URL?>/cursos.php"><i class="far fa-list-alt mr-2"></i>Cursos</a></li>
      <li><a href="<?=$BASE_URL?>/faq.php"><i class="far fa-question-circle mr-2"></i>Preguntas Frecuentes</a></li>
      <li><a href="<?=$BASE_URL?>/index.php#contacto"><i class="fas fa-mail-bulk mr-2"></i>Contacto</a></li>
    </ul>
    <?php if($usuarioLogueado):?>
    <ul>
        <h5>@<?=$userA->getUserName()?></h5>
      <li><a href="<?=$BASE_URL?>/usuario/userProfile.php">Mi perfil</a></li>
      <li><a href="<?=$BASE_URL?>/index.php?logout=0"><i class="fas fa-sign-out-alt"data-toggle="tooltip" data-placement="bottom" title="Cerrar Sesión"></i></a></li>
    </ul>
    <?php endif;?>
  </div>
  <div class="info">
    <ul>
      <li>Copyright Promunity 2019 <i class="far fa-copyright"></i></li>
      <li><a href="https://github.com/danieltapia2019/ProyectoIntegrador-INET"><i
            class="fab fa-github mr-2"></i>Proyecto Interador INET</a></li>
      <li>Powered by<i class="fab fa-html5 ml-3 html"></i><i class="fab fa-css3-alt ml-3 css"></i><i
          class="fab fa-js ml-3 js"></i><i class="fab fa-php ml-3 php"></i></li>
    </ul>
  </div>
</footer>