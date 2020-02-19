<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{url('/home')}}">
            <img src="{{ asset('img/logo.png') }}" alt="NavBarPicture" width=60px>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/home')}}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cursos
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Acerca de </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/home/faq') }}">F.A.Q</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#contacto">Contacto</a>
                    </div>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modalInicio">
                        <i class="fas fa-sign-in-alt" data-toggle="tooltip" data-placement="bottom"
                            title="Inicio de Sesión"></i>
                    </a>
                </li>
                {{-- @guest --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif --}}
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Registro-->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bienvenido a Promunity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                    </div>
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
                            placeholder="Ingrese contraseña" id="passwordRegister" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" name="button"
                                onclick="mostrarContrasena()">
                                <i name="eye" id="ojoRegister" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                        {{-- <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" name="button"
                                onclick="mostrarContrasena()">
                                <i name="eye" id="ojoRegister" class="far fa-eye"></i>
                            </button>
                        </div> --}}
                    </div>

                    <div id="imagenNombre">
                        <div class="input-group mb-3">
                            <img src="/img/perfil.jpg" alt="" id="imgNormal">
                            <img id="imagenPrevisualizacion" class="rounded-circle mx-2" style="display: none;">
                            <div class="custom-file">
                                <input name="fotoPerfil" type="file" class="custom-file-input" id="seleccionArchivos"
                                    accept="image/*" data-max-size="2048">
                                <label accept="image/* " class="custom-file-label" for="inputGroupFile01">Foto</label>
                            </div>
                        </div>
                        <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                        <script>
                            const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
                                $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
                            // Escuchar cuando cambie
                            $seleccionArchivos.addEventListener("change", () => {
                                imagenNormal = document.getElementById('imgNormal').style.display = "none";
                                imagenElegida = document.getElementById('imagenPrevisualizacion').style
                                    .display = "inherit";
                                // Los archivos seleccionados, pueden ser muchos o uno
                                const archivos = $seleccionArchivos.files;
                                // Si no hay archivos salimos de la función y quitamos la imagen
                                if (!archivos || !archivos.length) {
                                    $imagenPrevisualizacion.src = "";
                                    imagenNormal = document.getElementById('imgNormal').style.display =
                                        "inherit";
                                    imagenElegida = document.getElementById('imagenPrevisualizacion').style
                                        .display = "none";
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
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 ">Registrarse</button>
                </form>
                <p class="h6 text-center">Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.
                </p>
                <div class="">
                    <hr>
                </div>
                <h6 class="h6 text-center">¿Ya tienes una cuenta?</h6>
                <button class="btn btn-regSignIn" data-toggle="modal" data-target="#modalInicio" id="button"
                    onclick="cerrarModalActivo()">Inicia Sesión</i></button>
            </div>
        </div>
    </div>
</div>
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
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
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
<script>
    function mostrarContrasena() {

        var tipoLogin = document.getElementById("password");
        var ojoLogin = document.getElementById("ojoOn");
        var modalInicio = $("#modalInicio").is(":visible");
        var tipoRegister = document.getElementById("passwordRegister");
        var ojoRegister = document.getElementById("ojoRegister");

        if (modalInicio) { //si el modal inicio esta activo
            if (tipoLogin.type == "password") {
                tipoLogin.type = "text";
                ojoLogin.name = "eye-off";
            } else {
                tipoLogin.type = "password";
                ojoLogin.name = "eye";
            }
        } else { //si el modal register esta activo

            if (tipoRegister.type == "password") {
                tipoRegister.type = "text";
                ojoRegister.name = "eye-off";
            } else {
                tipoRegister.type = "password";
                ojoRegister.name = "eye";
            }
        }
    }

    function cerrarModalActivo() {
        var modalInicio = $("#modalInicio").is(":visible");
        if (modalInicio) {
            $('#modalInicio').modal('hide');
        } else {
            $('#modalRegistro').modal('hide');
        }
    }

</script>
