@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM')

@section('content')
<div class="conteiner">
    <div class="sideNavigation" id="sideNAV">
        <a href="#">
        @if (isset(auth()->user()->foto))
        <img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}" alt="{{auth()->user()->username}}" id="sideNAV">
        @else
        <img src="/img/perfil.jpg" alt="" class="" id="imgSideNav">
        @endif
        </a>
        <a>Administrador:</a>
        <a href="/perfil">{{auth()->user()->username}}</a>
        <a href="/home"> <img src="/img/logo.png" alt=""  id="logoHOME"> </a>
        <a href="/setting"><i class="fas fa-cogs"></i>Settings</a>
    </div>

    <div class="abm-tablist">
        <nav class="row" id="navPC">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="home" aria-selected="true">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profesores-tab" data-toggle="tab" href="#profesores" role="tab" aria-controls="profile" aria-selected="false">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="administradores-tab" data-toggle="tab" href="#administradores" role="tab" aria-controls="contact" aria-selected="false">Administradores</a>
                </li>
                <li clas="nav-item">
                    <a class="nav-link" id="cursos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="contact" aria-selected="false">Cursos</a>
                </li>
                <li clas="nav-item">
                    <a class="nav-link" id="alumnos-cursos-tab" data-toggle="tab" href="#alumnos-cursos" role="tab" aria-controls="contact" aria-selected="false">Alumnos/Cursos</a>
                </li>
                <li clas="nav-item">
                    <a class="nav-link" id="tipos-tab" data-toggle="tab" href="#tipos" role="tab" aria-controls="contact" aria-selected="false">Tipos</a>
                </li>
                <li clas="nav-item">
                    <a class="nav-link" id="usos-tab" data-toggle="tab" href="#usos" role="tab" aria-controls="contact" aria-selected="false">Usos</a>
                </li>
            </ul>
        </nav>
        <nav class="nav flex-column">
          <script type="text/javascript">
            window.addEventListener("load", function() {
              if(window.innerWidth <= 425 ){
                alert('ATENCION, PARA UNA MEJOR EXPERIENCIA EN EL ABM SE RECOMIENDA UTILIZAR UNA COMPUTADORA');
              }
            });
          </script>
          <a class="nav-link active" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="home" aria-selected="true">Alumnos</a>
          <a class="nav-link" id="profesores-tab" data-toggle="tab" href="#profesores" role="tab" aria-controls="profile" aria-selected="false">Profesores</a>
          <a class="nav-link" id="administradores-tab" data-toggle="tab" href="#administradores" role="tab" aria-controls="contact" aria-selected="false">Administradores</a>
          <a class="nav-link" id="cursos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="contact" aria-selected="false">Cursos</a>
          <a class="nav-link" id="alumnos-cursos-tab" data-toggle="tab" href="#alumnos-cursos" role="tab" aria-controls="contact" aria-selected="false">Alumnos/Cursos</a>
          <a class="nav-link" id="tipos-tab" data-toggle="tab" href="#tipos" role="tab" aria-controls="contact" aria-selected="false">Tipos</a>
          <a class="nav-link" id="usos-tab" data-toggle="tab" href="#usos" role="tab" aria-controls="contact" aria-selected="false">Usos</a>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active usuarios" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                <table class="table table-light mt-3 mb-5 usuario">
                    <thead>
                        <tr>
                            <th id="IDregistro">ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $key => $alumno)
                        <tr>
                            <td id="IDregistro">{{$alumno->id}}</td>
                            <td>{{$alumno->username}}</td>
                            <td>{{$alumno->email}}</td>
                            <td>
                                <div class="row">
                                   <button type="button" onclick="borrarRegistro({{$alumno->id}},this,1)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                                    <hr>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario" onclick="editarUsuario({{$alumno}},this)">Editar</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Alumnos :(</h3>
                        {{$alumnos->links()}}
                        @endforelse
                    </tbody>
                </table>
                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUsuario">Agregar</button>

            </div>
            <div class="tab-pane fade usuarios" id="administradores" role="tabpanel" aria-labelledby="profesores-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th id="IDregistro">ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $key => $admin)
                        <tr>
                            <td id="IDregistro">{{$admin->id}}</td>
                            <td>{{$admin->username}}</td>
                            <td>{{$admin->email}}</td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Admins :(</h3>
                        @endforelse
                        {{$admins->links()}}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profesores" role="tabpanel" aria-labelledby="administradores-tab">
                <table class="table table-light mt-3 mb-5 usuarios">
                    <thead>
                        <tr>
                            <th id="IDregistro">ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($profesores as $key => $profesor)
                        <tr>
                            <td id="IDregistro">{{$profesor->id}}</td>
                            <td>{{$profesor->username}}</td>
                            <td>{{$profesor->email}}</td>
                            <td>
                                <div class="row">
                                   <button type="button" onclick="borrarRegistro({{$profesor->id}},this,1)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                                    <hr>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario" onclick="editarUsuario({{$profesor}},this)">Editar</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay profesores :(</h3>
                        @endforelse

                        {{$profesores->links()}}
                    </tbody>
                </table>
                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUsuario">Agregar</button>
            </div>
            <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th id="IDregistro">ID</th>
                            <th>Titulo</th>
                            <th>Lenguaje</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Uso</th>
                            <th>Autor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cursos as $key => $curso)
                        <tr>
                            <th id="IDregistro">{{$curso->id}}</th>
                            <td>{{$curso->titulo}}</td>
                            <td>{{$curso->lenguaje}}</td>
                            <td>{{$curso->precio}}</td>
                            <td>{{$curso->tipo->tipoNombre}}</td>
                            <td>{{$curso->uso->usoNombre}}</td>
                            <td>{{$curso->creador->username}}</td>
                            <td>
                                <div class="row">
                                    <button type="button" onclick="borrarRegistro({{$curso->id}},this,2)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                                    <hr>
                                    <button class="btn btn-primary" name="button">
                                        <a href="/editar/curso/{{$curso->id}}" style="color:white"> Editar </a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
                        @endforelse
                        {{$cursos->links()}}
                    </tbody>
                </table>
                <a href="/perfil">
                    <button type="button" class="btn btn-success mb-3" name="button">Agregar</button></a>

            </div>
            <div class="tab-pane fade" id="alumnos-cursos" role="tabpanel" aria-labelledby="alumnos-cursos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Alumno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cursos as $key => $curso)
                        <tr>
                            @forelse ($curso->alumno as $key => $alumno)
                              <tr>

                              <td>{{$curso->titulo}}</td>
                              <td>{{$alumno->username}}</td>
                            @empty
                            <td>No hay alumnos inscriptos</td>
                            @endforelse
                            </tr>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="tipos" role="tabpanel" aria-labelledby="tipos-tab">
                <table class="table table-light mt-3 mb-5 tipos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tipos as $key => $tipo)
                        <tr>
                        <td>{{$tipo->id}}</td>
                        <td>{{$tipo->tipoNombre}}</td>
                        <td>
                            <div class="row">
                                <button type="button" onclick="borrarRegistro({{$tipo->id}},this,3)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                                <hr>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipo" onclick="editarTipo({{$tipo}},this)">Editar</button>
                            </div>
                        </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Tipo :(</h3>
                        @endforelse
                        {{$tipos->links()}}
                    </tbody>

                </table>

                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalTipo">Agregar</button>

            </div>

            <div class="tab-pane fade" id="usos" role="tabpanel" aria-labelledby="usos-tab">
                <table class="table table-light mt-3 mb-5 usos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Uso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usos as $key => $uso)
                        <tr>
                        <td>{{$uso->id}}</td>
                        <td>{{$uso->usoNombre}}</td>
                        <td>
                            <div class="row">
                                <button type="button" onclick="borrarRegistro({{$uso->id}},this,4)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                                <hr>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUso" onclick="editarUso({{$uso}},this)">Editar</button>
                            </div>
                        </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Uso :(</h3>
                        @endforelse
                        {{$usos->links()}}
                    </tbody>

                </table>

                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUso">Agregar</button>

            </div>
        </div>
    </div>
</div>{{-- /Conteiner--}}

<!-- Modal Tipo-->
<div class="modal fade" id="modalTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar tipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="tipo-form" action="" method="post">
                    {{csrf_field()}}
                    <div class="input-grup mb-3">
                        <input type="text" name="tnombre" class="form-control" placeholder="Tipo" required>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-tipo">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Uso-->
<div class="modal fade" id="modalUso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar uso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="uso-form" action="" method="post">
                    {{csrf_field()}}
                    <div class="input-grup mb-3">
                        <input type="text" name="snombre" class="form-control" placeholder="Uso" required>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-uso">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Crear Usuario-->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user-form" action="" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Nombre de usuario"
                            required>
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
                        <input type="password" name="password" class="form-control password" aria-label="password"
                            placeholder="Ingrese contraseña" id="password" required minlength="8">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" name="button"
                                onclick="mostrarContrasena()">
                                <i name="" id="ojo" class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirmar contraseña" minlength="8">
                    </div>
                    <label for="acceso">Nivel de acceso:</label>
                    <div class="input-group mb-3">
                        <select name="acceso">
                            <option value="2">Alumno</option>
                            <option value="1">Profesor</option>
                            <option value="0">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-user">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
