<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="NavBarPicture" width=60px>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Cursos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">Lenguajes de
                        Programacion</a>
                    <a class="dropdown-item" href="">Desarrollo de
                        Videojuegos</a>
                    <a class="dropdown-item" href="">Desarrollo Web</a>
                    <a class="dropdown-item" href="">Aplicaciones Moviles</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Mas cursos...</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"> Acerca de </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">F.A.Q</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Contacto</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#modalInicio">
                    <i class="fas fa-sign-in-alt" data-toggle="tooltip" data-placement="bottom"
                        title="Inicio de Sesión"></i>
                </a>
            </li>
            <!-- /User actions -->
        </ul>
    </div>
</nav>
<!-- Modal Inicio-->
<div class="modal fade" id="modalInicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="container">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bienvenido! Inicia Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" aria-label="email"
                                placeholder="Ingrese email" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" aria-label="password"
                                placeholder="Ingrese contraseña" id="password" maxlength="20" minlength="6" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary" name="button"
                                    onclick="mostrarContrasena()">
                                    <i name="eye" id="ojoOn" class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>
                        <button type="submit" class="btn btn-signIn btn-lg btn-block my-3 ">Iniciar Sesión</button>
                    </form>
                    <p class="text-center"> <a href="#">¿Has olvidado tu contraseña?</a></p>
                    <p class="text-center mt-3">¿No tienes cuenta?
                        <button class="btn btn-signUp" data-toggle="modal" data-target="#modalRegistro"
                            onclick="cerrarModalActivo()" id="button">Registrate</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
