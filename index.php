<?php
include ("data/usuario.php");
session_start();
if(isset($_GET["logout"])){
  session_destroy();
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promunity</title>
  <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/stylePrincipal.css">
  <link rel="shortcut icon" href="img\logo.png" />
</head>

<body>
  <div class="container-fuild">
    <!--Navbar-->
    <?php include("componentes/navbar.php"); ?>



    <section>
      <div id=presentacion >
        <div id=cajanegra >
          <p class=h5>Tomate tu tiempo. Accede a cualquier curso y terminalo cuando quieras. No hay limite de tiempo.
          </p>
          <p class=h3>
            ¿Qué estás esperando?
          </p>
          <div class="input-group mb-3 mt-4">
            <input type="text" id="busquedaSection" class="form-control" placeholder="¿Qué quieres aprender?" aria-label="¿Qué quieres aprender?" aria-describedby="botonbusq">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="botonbusq"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <div id="iconos">
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-visa"></i>
            <i class="fab fa-cc-paypal"></i>

          </div>



        </div>

      </div>
      <div id="mas-vistos" >
        <p class=h2>
          Cursos mas visitados
        </p>
        <article class="border border-secundary border-top-0 curso">
          <img src="img/cursos.jpg" alt="">
          <h4>"Titulo"</h4>
          <p>Autor</p>
          <p>Precio</p>
          <p>Duracion</p>

        </article>
        <article class="border border-secundary border-top-0 curso">
          <img src="img/cursos.jpg" alt="">
          <h4>"Titulo"</h4>
          <p>Autor</p>
          <p>Precio</p>
          <p>Duracion</p>
        </article>
        <article class="border border-secundary border-top-0 curso">
          <img src="img/cursos.jpg" alt="">
          <h4>"Titulo"</h4>
          <p>Autor</p>
          <p>Precio</p>
          <p>Duracion</p>
        </article>

        <article class="border border-secundary border-top-0 curso">
          <img src="img/cursos.jpg" alt="">
          <h4>"Titulo"</h4>
          <p>Autor</p>
          <p>Precio</p>
          <p>Duracion</p>
          </article>
      </div>

    </section>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <article class="border border-secundary border-top-0 curso">
      <img src="img/cursos.jpg" alt="">
      <h4>"Titulo"</h4>
      <p>Autor</p>
      <p>Precio</p>
      <p>Duracion</p>
    </article>
    </div>
    <div class="carousel-item">
    <article class="border border-secundary border-top-0 curso">
      <img src="img/cursos.jpg" alt="">
      <h4>"Titulo"</h4>
      <p>Autor</p>
      <p>Precio</p>
      <p>Duracion</p>
    </article>
    </div>
    <div class="carousel-item">
    <article class="border border-secundary border-top-0 curso">
      <img src="img/cursos.jpg" alt="">
      <h4>"Titulo"</h4>
      <p>Autor</p>
      <p>Precio</p>
      <p>Duracion</p>
    </article>
    </div>

    <div class="carousel-item">
    <article class="border border-secundary border-top-0 curso">
      <img src="img/cursos.jpg" alt="">
      <h4>"Titulo"</h4>
      <p>Autor</p>
      <p>Precio</p>
      <p>Duracion</p>
    </article>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <div id="contacto">
      <p class="h2 mb-5">Contacto</p>
      <form >
        <div class="form-row">
          <form class="" action="index.html" method="post">

            <div class="datosContacto">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
              </div>
              <div class="form-group">
                <label for="nombre">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Direccion de email" required>
              </div>
              <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" id="telefono" placeholder="Cod.Area-Numero ej. 261-155232343" required>
              </div>

            </div>
            <div class="col-md-5 mx-4 textArea">
              <div class="form-group mb-4">
                <label for="textoarea">Consulta</label>
                <textarea class="form-control" id="textoarea" rows="5" required></textarea>
              </div>
              <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Enviar</button>

            </div>

          </form>

        </div>

      </form>

    </div>
    <div id="opiniones">
      <p class="h2 mb-5">¿Qué opinan nuestros alumnos?</p>
      <div class="articuloOpiniones">
        <article class="border border-secundary border-bottom-0 opinion">
          <span class=h4><img src="img/alumno1.jpeg" alt="">Estudiante</span>
          <p>Promunity es una muy buena pagina para aprender programacion desde 0 excelente cursos y la informacion es didactica</p>
        </article>
        <article class="border border-secundary border-bottom-0 opinion">
          <span class=h4><img src="img/alumno2.jpeg" alt="">Estudiante</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
        </article>
        <article class="border border-secundary border-bottom-0 opinion">
          <span class=h4><img src="img/alumno3.jpeg" alt="">Estudiante</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
        </article>
        <article class="border border-secundary border-bottom-0 opinion">
          <span class=h4><img src="img/alumno4.jpeg" alt="">Estudiante</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
        </article>
      </div>

      </div>

        <!--Carrusel solo para mobile-->
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
      <article class="border border-secundary border-bottom-0 opinion">
        <span class=h4><img src="img/alumno1.jpeg" alt="">Estudiante</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
      </article>
      </div>
      <div class="carousel-item">
      <article class="border border-secundary border-bottom-0 opinion">
        <span class=h4><img src="img/alumno2.jpeg" alt="">Estudiante</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
      </article>
      </div>
      <div class="carousel-item">
      <article class="border border-secundary border-bottom-0 opinion">
        <span class=h4><img src="img/alumno3.jpeg" alt="">Estudiante</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consequatur repellendus sint in temporibus! Beatae!</p>
      </article>
      </div>

    </div>
  </div>

        <!--Footer-->
        <?php include("/componentes/footer.php") ?>

</div>








  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
