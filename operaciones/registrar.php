<?php
include("../rutas.php");
include("../data/conexion.php");
include("../data/usuario.php");
//clase usuario con atributos, metodos getter and setters

session_start();

$usuarios = mysqli_query($conexion,"SELECT id,username,email,pwd,foto,acceso FROM usuarios");
$errorExistente="-1";
if($_POST){
  $claseUsuario = new Usuario($_POST["username"],$_POST["email"],$_POST["password"]);
  $claseUsuario->setAcceso(2);
    while($fila = mysqli_fetch_row($usuarios)){
      if($fila[1] == $claseUsuario->getUserName()){
        $errorExistente = 0;
        break;
      }
      if($fila[2] == $claseUsuario->getEmail()){
        $errorExistente = 1;
        break;
      }
  }
  if($errorExistente==-1){
    if($_FILES["fotoPerfil"]["name"] != null){
      $extension =  pathinfo($_FILES["fotoPerfil"]["name"],PATHINFO_EXTENSION);
      $claseUsuario->setFoto($claseUsuario->getUserName().".".$extension);
    }else{
      $claseUsuario->setFoto(NULL);
    }
    $_SESSION["usuario"]=$claseUsuario;
    $usuario = $claseUsuario->getUserName();
    $email = $claseUsuario->getEmail();
    $password = $claseUsuario->getPassword();
    $foto = $claseUsuario->getFoto();
    $acceso = $claseUsuario->getAcceso();
    $insertarUsuario = "INSERT INTO usuarios (username,email,pwd,foto,acceso) VALUES ('$usuario','$email','$password','$foto','$acceso')";
    $insertar = mysqli_query($conexion,$insertarUsuario);
    header('Location:./../usuario/perfil1.php');
    move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"],"../img/fotoPerfil/".$foto);
  }
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesion</title>
  <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/loguear.css">
  <link rel="shortcut icon" href="../img/logo.png" />
 </head>
 <body>
     <div class="container-fuild">

         <?php include ("../componentes/navbar.php") ?>
            <div class="modal-body">
            <?php if($errorExistente==0):?>
                <p>Nombre de Usuario en uso. Por favor elija otro.</p>
            <?php elseif($errorExistente==1):?>
                <p>Este email ya esta registrado en una cuenta activa.</p>
            <?php endif;?>
            <form class="" action="registrar.php" method="post">
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
                <input type="email" name="email" class="form-control" aria-label="email" placeholder="Ingrese email">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" required maxlength="20" minlength="6">
              </div>
              <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Registrarse</button>
            </form>





        </div>


                          <?php include ("../componentes/footer.php") ?>
     </div>



    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 </body>
 </html>
