@extends('layout.app')

@section('css','css/index.css')
@section('title','Home')

@section('content')
<header class="bienvenido">
    <div class="usuario">
        <!--SideNav-->
        <div id="sideNavigation" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#" onclick="abrirMisCursos()">
                <ion-icon name="briefcase"></ion-icon>
                Mis cursos
            </a>
            <?php //if($_SESSION["usuario"]->getAcceso() < 2): ?>
            <a href="#">
                <ion-icon name="add-circle"></ion-icon>
                Dar un curso
            </a>
            <?php //endif; ?>
            <a href="#" onclick="abrirConfiguracion()">
                <ion-icon name="build"></ion-icon>
                Configuracion
            </a>
        </div>

        <nav class="topnav">
            <a href="#" onclick="openNav()">
                <ion-icon name="menu" size="large">
                </ion-icon>
            </a>
        </nav>
        <br>
        <h1>Bienvenido a su cuenta <?php //echo $userName?>
        </h1>
    </div>
</header>
<section class="opciones">
    <!--Mis cursos-->
    <div class="mis-cursos" id="misCursos" style="display: none;">
        <?php //foreach($conexion->query($consulta) as $row) :?>
        <article class="border border-secundary border-top-0 curso">
            <div class="card" style="width: 18rem;">
                <img src="<?php //echo $BASE_URL."/img/fotoCurso/".$row['foto_curso']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php //echo $row['titulo']?></h5>
                    <p>Lenguaje: <?php //echo $row['lenguaje']?></p>
                    <?php //if($_SESSION["usuario"]->getAcceso() == 1): ?>
                    <h6>Alumnos: </h6>
                    <a href="#" class="btn btn-primary">Borrar Curso</a>
                    <?php //endif; ?>
                </div>
                <p syle="display:none">id <?php //echo $row['id']?></p>
                <a href="perfil1.php?id=<?php //echo $row['id']?>">Ir al curso</a>
            </div>

        </article>
        <?php //endforeach;  ?>
    </div>
    <!--Dar curso-->
    <div class="crear-curso" id="crearCurso" style="display: none;">
        <form class="" action="" method="post">
        </form>
    </div>
    <!--Favoritos-->
    <!--Configuracion-->
    <div class="configuracion" id="configuracion">
        <form class="" action="perfil1.php" method="post">

            <div id="imagenNombre">

                <div class="input-group mb-3">
                    <?php //if($fotoPerfil == "no"): ?>
                    <img src="<?php //echo $BASE_URL?>/img/perfil.jpg" alt="" id="imgNormal">
                    <?php //else: ?>
                    <img src="<?php //echo $BASE_URL?>/img/fotoPerfil/<?php //echo $fotoPerfil?>" alt=""
                        class="rounded-circle mx-2" id="imgNormal"></span>
                    <?php //endif; ?>
                    <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="seleccionArchivos" required>
                        <label accept="image/* " class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
                    </div>
                </div>

                <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                <script>
                    const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
                        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

                    // Escuchar cuando cambie
                    $seleccionArchivos.addEventListener("change", () => {
                        imagenNormal = document.getElementById('imgNormal').style.display = "none";
                        imagenElegida = document.getElementById('imagenPrevisualizacion').style.display =
                            "inherit";
                        // Los archivos seleccionados, pueden ser muchos o uno
                        const archivos = $seleccionArchivos.files;
                        // Si no hay archivos salimos de la función y quitamos la imagen
                        if (!archivos || !archivos.length) {
                            $imagenPrevisualizacion.src = "";
                            imagenNormal = document.getElementById('imgNormal').style.display = "inherit";
                            imagenElegida = document.getElementById('imagenPrevisualizacion').style.display =
                                "none";
                            return;
                        }
                        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                        const primerArchivo = archivos[0];
                        // Lo convertimos a un objeto de tipo objectURL
                        const objectURL = URL.createObjectURL(primerArchivo);
                        // Y a la fuente de la imagen le ponemos el objectURL
                        $imagenPrevisualizacion.src = objectURL;
                    });

                </script>
            </div>
            <button class="btn btn-success btn-sm" type="submit" name="button">
                Guardar foto
            </button>

        </form>
        <form class="" action="" method="post">
            <hr>
            <div class="form-group">
                <label for="exampleInputEmail1">Cambiar Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" value=<?php //echo $userEmail?>>
            </div>
            <hr>
            <label for="password">Contraseña actual</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" aria-label="password"
                    placeholder="Ingrese contraseña" id="passwordRegister" required>
                <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()">
                    <ion-icon name="eye" id="ojoRegister"></ion-icon>
                </button>

            </div>
            <hr>
            <label for="password">Contraseña nueva</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" aria-label="password"
                    placeholder="Ingrese contraseña" id="passwordRegister">
                <button class="btn btn-primary" type="button" name="button" onclick="mostrarContrasena()" required>
                    <ion-icon name="eye" id="ojoRegister"></ion-icon>
                </button>

            </div>
            <button type="submit" name="button" class="btn btn-success">
                Guardar Cambios
            </button>
        </form>
    </div>
</section>
<script>
    function abrirFavoritos() {
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById('perfil').style.display = "none";
    }

    function abrirMisCursos() {
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById('perfil').style.display = "none";
        document.getElementById('config').style.display = "none";
        document.getElementById("misCursos").style.display = "inherit";
    }

    function abrirPerfil() {
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById("misCursos").style.display = "none";
        document.getElementById('config').style.display = "none";
        document.getElementById('perfil').style.display = "inherit";
    }

    function abrirConfiguracion() {
        document.getElementById("sideNavigation").style.width = "0";
        document.getElementById('misCursos').style.display = "none";
        document.getElementById('perfil').style.display = "none";
        document.getElementById('config').style.display = "inherit";
    }

    function openNav() {
        document.getElementById("sideNavigation").style.width = "200px";
    }

    function closeNav() {
        document.getElementById("sideNavigation").style.width = "0";
    }

    function mostrarContrasena() {
        var tipoLogin = document.getElementById("password");
        var ojoLogin = document.getElementById("ojoOn");
        var tipoRegister = document.getElementById("passwordRegister");
        var ojoRegister = document.getElementById("ojoRegister");
        if (tipoLogin.type == "password") {
            tipoLogin.type = "text";
            ojoLogin.name = "eye-off";
        } else {
            tipoLogin.type = "password";
            ojoLogin.name = "eye";
        }
        if (tipoRegister.type == "password") {
            tipoRegister.type = "text";
            ojoRegister.name = "eye-off";
        } else {
            tipoRegister.type = "password";
            ojoRegister.name = "eye";
        }
    }

</script>
@endsection
