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
          <li>
            <a href="<?=$BASE_URL?>/faq.php">
              <ion-icon name="help"></ion-icon>
              Preguntas Frecuentes</a>
          </li>
          <li>
            <a href="<?=$BASE_URL?>/index.php">
              <ion-icon name="home"></ion-icon>
              Home</a></li>
          <li>
          <a href="<?=$BASE_URL?>/index.php#contacto">
            <ion-icon name="contact"></ion-icon>
            Contacto</a></li>
        </ul>
      </div>
      <div class="info">
          <h4>
            2019 Promunity, inc
          </h4>
          <ion-icon name="logo-html5"></ion-icon>
          <ion-icon name="logo-javascript"></ion-icon>
          <a href="https://github.com/danieltapia2019/ProyectoIntegrador-INET">
            <ion-icon name="logo-github"></ion-icon></a>
      </div>

    </footer>
