<?php

include_once ('rutas.php');
include ("data/conexion.php");
include ("data/usuario.php");

session_start();
if($_SESSION){
  if($_SESSION["usuario"]->getAcceso() != 0){
    header('Location:index.php');
  }
}else {
  header('Location:index.php');
}
$elegido = "Alumnos";
$consulta = "SELECT usuarios.id , usuarios.username ,usuarios.email FROM usuarios WHERE usuarios.acceso = 2";
$indice = 0;

if($_POST){
  $indice = $_POST["busqueda"];
  switch ($indice) {
    case 0:
    //alumnos
    $consulta = "SELECT usuarios.id , usuarios.username ,usuarios.email FROM usuarios WHERE usuarios.acceso = 2";
    $elegido = "Alumnos";
      break;
    case 1:
    //Profesores
    $consulta = "SELECT usuarios.id , usuarios.username ,usuarios.email FROM usuarios WHERE usuarios.acceso = 1";
    $elegido = "Profesores";
      break;
    case 2:
    //Administradores
    $consulta = "SELECT usuarios.id , usuarios.username ,usuarios.email FROM usuarios WHERE usuarios.acceso = 0";
    $elegido = "Administradores";
      break;
    case 3:
    //Cursos
    $consulta = "SELECT curso.id, curso.titulo ,curso.lenguaje ,curso.precio, user.username FROM curso , usuarios AS user WHERE curso.autor = user.id";
    $elegido = "Cursos";
      break;
    case 4:
    //Cursos/Alumno
    $elegido = "Cursos/Alumnos";
    $consulta = "SELECT alumnos.username, cursos.curso_nombre FROM usuario_curso,curso AS cursos, usuarios AS alumnos WHERE usuario_curso.id_usuario = alumnos.id AND usuario_curso.id_curso = cursos.id";
      break;

    default:

    $consulta = "SELECT usuario.id , usuario.username ,usuario.email FROM usuario WHERE usuario.acceso = 2";
      break;
  }
}
$resultado = mysqli_query($conexion,$consulta);
 ?>
 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>ABM Promunity</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="css/stylePrincipal.css">
   </head>
   <body>
     <div class="container-fuild">
       <?php include("componentes/navbar.php") ?>
       <header>
         <h1>Bienvenido al ABM de Promunity</h1>
         <img src="" alt="">
         <hr>
         <p>¿Que desea buscar?</p>
         <form class="" action="abm.php" method="post">
           <select name="busqueda">
             <option value=<?php echo $indice;?> selected="true" disabled="disabled"><?php echo $elegido; ?></option>
             <option value="0">Alumnos</option>
             <option value="1">Profesores</option>
             <option value="2">Administradores</option>
             <option value="3">Cursos</option>
             <option value="4">Alumno/Curso</option>
           </select>
           <button type="submit" class="btn btn-primary">Buscar</button>
         </form>
     </header>
     <main>
       <button class="btn btn-success" type="button" name="button" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
       <hr>
       <table class="table table-dark">
         <thead>
           <tr>
             <?php if($indice == 0 || $indice == 1 || $indice == 2): ?>
             <th scope="col">ID</th>
             <th>Usuario</th>
             <th>Email</th>
            <?php endif; ?>
            <?php if($indice == 3): ?>
             <th scope="col">ID</th>
             <th>Titulo</th>
             <th>Lenguaje</th>
             <th>Precio</th>
             <th>Autor</th>
            <?php endif; ?>
            <?php if($indice == 4): ?>
              <th>Alumno</th>
              <th>Curso</th>
            <?php endif; ?>
           </tr>
         </thead>
         <tbody>

           <?php while($fila = mysqli_fetch_row($resultado)){ ?>
           <tr>
             <?php if($indice == 0 || $indice == 1 || $indice == 2): ?>
             <td><?php echo $fila[0]; ?></td>
             <td><?php echo $fila[1]; ?></td>
             <td><?php echo $fila[2]; ?></td>
            <?php endif; ?>
            <?php if($indice == 3): ?>
             <td><?php echo $fila[0]; ?></td>
             <td><?php echo $fila[1]; ?></td>
             <td><?php echo $fila[2]; ?></td>
             <td><?php echo $fila[3]; ?></td>
             <td><?php echo $fila[4]; ?></td>
            <?php endif; ?>
            <?php if($indice == 4): ?>
             <td><?php echo $fila[0]; ?></td>
             <td><?php echo $fila[1]; ?></td>
            <?php endif; ?>

             <td> <button class="btn btn-danger" type="button" name="button">Eliminar</button> </td>
             <td> <button class="btn btn-warning" type="button" name="button">Editar</button> </td>
           </tr>
         <?php } ?>
         </tbody>
       </table>

     </main>

     <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Agregar <?=$elegido?></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <form class="" action="abm.php" method="post">
           <?php if($indice == 0 || $indice == 1 || $indice == 2): ?>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="fas fa-user"></i></span>
               </div>
               <input type="text" name="nombre" class="form-control" aria-label="nombre" placeholder="Ingrese Nombre de Usuario" required>
             </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
               </div>
               <input type="email" name="adn" class="form-control" aria-label="adn" placeholder="Ingrese Email" required>
             </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="fas fa-lock"></i></span>
               </div>
               <input type="password" name="adn" class="form-control" aria-label="adn" placeholder="Ingrese Contraseña" required>
             </div>

           <?php endif; ?>
           <?php if($indice == 3):?>
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
             </div>
             <input type="password" name="adn" class="form-control" aria-label="adn" placeholder="Ingrese Nombre del Curso" required>
           </div>
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
             </div>
             <input type="password" name="adn" class="form-control" aria-label="adn" placeholder="Ingrese Lenguaje del curso" required>
           </div>
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
             </div>
             <input type="password" name="adn" class="form-control" aria-label="adn" placeholder="Ingrese Autor" required>
           </div>
           <?php endif; ?>

             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary">Aceptar</button>
             </div>
         </form>
       </div>
     </div>
   </div>
 </div>

<?php include("componentes/footer.php") ?>
</div>


<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
   </body>

 </html>
