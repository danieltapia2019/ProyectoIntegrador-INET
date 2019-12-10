<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header('Location:index.php');
}

$userName = "";
$userEmail = "";
if(isset($_SESSION)){
  if(sizeof($_SESSION) !=0){
  $userName = $_SESSION["usuario"]["username"];
  $userEmail = $_SESSION["usuario"]["email"];
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
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="perfilStyle.css">
  <link rel="shortcut icon" href="img\logo.png" />
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
      <a href="#">
        <ion-icon name="briefcase"></ion-icon>
        Mis cursos</a>
      <a href="#">
        <ion-icon name="add-circle"></ion-icon>
        Dar un curso</a>
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
      <section>
        <!--Mis cursos-->
        <!--Dar curso-->
        <!--Favoritos-->
                <!--Configuracion-->
              <div class="configuracion" style="display: none;" id="configuracion">
                            <form class="" action="" method="">
                              <div class="form-group">
                          <label for="exampleInputEmail1">Cambiar Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"
                          value=<?=$userEmail?>>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Contraseña Actual</label>
                          <input type="password" class="form-control" placeholder="Password" id="password">
                          <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()">
                              <ion-icon name="eye" id="ojoOn"></ion-icon>
                          </button>
                        </div>

                          <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña Nueva</label>
                            <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" id="passwordRegister">
                            <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()">
                                <ion-icon name="eye" id="ojoRegister"></ion-icon>
                            </button>  </div>

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

    function abrirConfiguracion(){
      document.getElementById("sideNavigation").style.width = "0";
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
