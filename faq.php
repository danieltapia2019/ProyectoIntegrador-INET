<?php
include ("data/usuario.php");
session_start();
$userName = "";
if(isset($_SESSION)){
  if(sizeof($_SESSION) !=0){
  $userName = $_SESSION["usuario"]->getUserName();
}
  else {
    $userName = "";
  }
}
if(isset($_GET["logout"])){
  session_destroy();
  header('Location: faq.php');
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylePrincipal.css">
    <link rel="shortcut icon" href="img\logo.png" />
    <title>Centro de ayuda</title>
  </head>
  <body>
    <div class="container-fuild">


    <?php include("componentes/navbar.php"); ?>
      <header class = "header">
        <div class="usuario">
          <br>
            <h1>Hola <?=$userName?>
              ¿Necesitas ayuda?
              </h1>
        </div>
      </header>

      <section class = "seccion">
        <div class="duda">
            <ul style="list-style : none;">
              <li>
                <a href="#sesion">Registrarse y Login</a>
              </li>
              <li>
                <a href="#curso">Inscribirse a un curso</a>
              </li>
              <li>
                <a href="#subir">Subir un curso</a>
              </li>
                <li>
                 <a href="#clases">¿Como son las clases?</a>
                </li>
                <li>
                  <a href="#pago">Metodos de pago</a>
                </li>
                <li>
                  <a href="#">Reportar un problema</a>
                </li>
            </ul>
        </div>
        <div class="contenido">
          <h4>Todo lo que necesitas saber para usar Promunity</h4>
            <article class="" id="sesion">
                <h5>Registrarse y Login</h5>
                <ul style="list-style: none;">
                  <li>
                    <a href="#">Registrarse</a>
                  </li>
                  <li>
                    <a href="#">Login</a>
                  </li>
                </ul>
            </article>
            <article class="" id= "curso">
                  <h5>Inscribirse a un curso</h5>
                  <ul style="list-style: none;">
                    <li>
                      <a href="#">Inscribirse online</a>
                    </li>
                  </ul>
            </article>
            <article class="" id="subir">

                  <h5>Subir un curso a Promunity</h5>
                  <ul style="list-style: none;">
                    <li>
                      <a href="#">Curso presencial</a>
                    </li>
                    <li>
                      <a href="">Curso presencial</a>
                    </li>
                  </ul>
            </article>
            <article class="" id="clases">

                  <h5>Clases en Promunity</h5>
                  <ul style="list-style: none;">
                    <li>
                      <a href="#">Clases presenciales</a>
                    </li>
                    <li>
                      <a href="">Clases online</a>
                    </li>
                  </ul>
            </article>
            <article class="" id="pago">

                  <h5>Metodos de pago</h5>
                  <ul style="list-style: none;">
                    <li>
                      <a href="#">Registrarse</a>
                    </li>
                    <li>
                      <a href="">Login</a>
                    </li>
                  </ul>
            </article>

        </div>
      </section>
      <?php include ("/componentes/footer.php") ?>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
