@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush
@section('metadatos')
<meta name="csrf-token" content="{{csrf_token()}}"/>
@endsection

@section('title','ABM')

@section('content')

<div class="conteiner">
    <div class="sideNavigation" id="sideNAV">
        {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> --}}
        <img src="/img/perfil.jpg" alt="" class="" id="imgSideNav">
        <a>Administrador:</a>
        <a href="/perfil">{{auth()->user()->username}}</a>
        <a href="/configuracion" onclick="abrirConfig()"><i class="fas fa-cogs"></i>Settings</a>
    </div>

    <div class="abm-tablist">
        <nav class="row">
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
                <li clas="nav-item">
                    <a class="nav-link" id="transacciones-tab" data-toggle="tab" href="#transacciones" role="tab" aria-controls="contact" aria-selected="false">Transacciones</a>
                </li>
            </ul>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $key => $alumno)
                        <tr>
                            <th scope="row">{{$alumno->id}}</th>
                            <td>{{$alumno->username}}</td>
                            <td>{{$alumno->email}}</td>
                            <td>
                                <div class="row">
                                    <form class="" action="/borrar/usuario" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value={{$alumno->id}}>
                                        <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
                                    </form>
                                    <hr>
                                    <button class="btn btn-primary" name="button">
                                        <a href="/editar/usuario/{{$alumno->id}}" style="color:white"> Editar </a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Alumnos :(</h3>
                        @endforelse
                    </tbody>
                </table>
                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUsuario">Agregar</button>

            </div>
            <div class="tab-pane fade" id="administradores" role="tabpanel" aria-labelledby="profesores-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $key => $admin)
                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->username}}</td>
                            <td>{{$admin->email}}</td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Admins :(</h3>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profesores" role="tabpanel" aria-labelledby="administradores-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($profesores as $key => $profesor)
                        <tr>
                            <th scope="row">{{$profesor->id}}</th>
                            <td>{{$profesor->username}}</td>
                            <td>{{$profesor->email}}</td>
                            <td>
                                <div class="row">
                                    <form class="" action="/borrar/usuario" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$profesor->id}}">
                                        <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
                                    </form>
                                    <hr>
                                    <button class="btn btn-primary" name="button">
                                        <a href="/editar/usuario/{{$profesor->id}}" style="color:white"> Editar </a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay profesores :(</h3>
                        @endforelse
                    </tbody>
                </table>
                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUsuario">Agregar</button>
            </div>
            <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <th scope="row">{{$curso->id}}</th>
                            <td>{{$curso->titulo}}</td>
                            <td>{{$curso->lenguaje}}</td>
                            <td>{{$curso->precio}}</td>
                            <td>{{$curso->tipo->tnombre}}</td>
                            <td>{{$curso->uso->snombre}}</td>
                            <td>{{$curso->creador->username}}</td>
                            <td>
                                <button class="btn btn-danger" name="button">
                                    <a href="" style="color:white"> Eliminar </a>
                                </button>
                                <button class="btn btn-primary" name="button">
                                    <a href="" style="color:white"> Editar </a>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
                        @endforelse
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
                            <td>{{$curso->titulo}}</td>
                            @forelse ($curso->alumno as $key => $alumno)
                            <td>{{$alumno->username}}</td>
                            @empty
                            <td>No hay alumnos inscriptos</td>
                            @endforelse
                        </tr>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="tipos" role="tabpanel" aria-labelledby="tipos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tipos as $key => $tipo)
                        <td>{{$tipo->id}}</td>
                        <td>{{$tipo->tnombre}}</td>
                        <td>
                            <div class="row">
                                <form class="" action="/borrar/uso" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value={{$tipo->id}}>
                                    <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
                                </form>
                                <hr>
                                <button class="btn btn-primary" name="button">
                                    <a href="/editar/tipo/{{$tipo->id}}" style="color:white"> Editar </a>
                                </button>
                            </div>
                        </td>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Tipo :(</h3>
                        @endforelse
                    </tbody>

                </table>

                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalTipo">Agregar</button>

            </div>

            <div class="tab-pane fade" id="usos" role="tabpanel" aria-labelledby="usos-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Uso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usos as $key => $uso)
                        <td>{{$uso->id}}</td>
                        <td>{{$uso->snombre}}</td>
                        <td>
                            <div class="row">
                                <form class="" action="/borrar/uso" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value={{$uso->id}}>
                                    <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
                                </form>
                                <hr>
                                <button class="btn btn-primary" name="button">
                                    <a href="/editar/uso/{{$uso->id}}" style="color:white"> Editar </a>
                                </button>
                            </div>
                        </td>
                        @empty
                        <h3 class="mt-5 mb-5">No hay Uso :(</h3>
                        @endforelse
                    </tbody>

                </table>

                <button type="button" class="btn btn-success mb-3" name="button" data-toggle="modal"
                    data-target="#modalUso">Agregar</button>

            </div>
            <div class="tab-pane fade" id="transacciones" role="tabpanel" aria-labelledby="transacciones-tab">
                <table class="table table-light mt-3 mb-5">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Curso</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($transacciones as $tra)
                        <tr>
                            <td>{{$tra->referencia}}</td>
                            @if($tra->estado==0)
                            <td>En proceso</td>
                            @else
                            <td>Pagado</td>
                            @endif
                            <td>{{$tra->usuario->username}}</td>
                            <td>{{$tra->curso->titulo}}</td>
                            <td>
                                <a class="btn btn-success activar" href="{{route('activar',$tra->id)}}" id="{{$tra->id}}">Activar</a>
                            </td>
                        </tr>
                    @empty
                        <h3 class="mt-5 mb-5">No hay Transacciones :(</h3>
                    @endforelse



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
                <form class="" action="/admin/crear/tipo" method="post">
                    {{csrf_field()}}
                    <div class="input-grup mb-3">
                        <input type="text" name="tnombre" class="form-control" placeholder="Tipo" required>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 ">Agregar</button>
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
                <form class="" action="/admin/crear/uso" method="post">
                    {{csrf_field()}}
                    <div class="input-grup mb-3">
                        <input type="text" name="snombre" class="form-control" placeholder="Uso" required>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 ">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Usuario-->
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
                <form class="" action="/crear/usuario" method="POST">
                    {{csrf_field()}}
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirmar contraseña">
                    </div>
                    <label for="acceso">Nivel de acceso:</label>
                    <div class="input-group mb-3">
                        <select name="acceso">
                            <option value="2">Alumno</option>
                            <option value="1">Profesor</option>
                            <option value="0">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-reg btn-lg btn-block my-3 ">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- -->
@endsection
@section('scripts')
<script src="{{ asset('js/abm.js') }}"></script>
@endsection
