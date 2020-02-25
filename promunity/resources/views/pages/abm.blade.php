@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@php
  use App\CursoModel;
  use App\CategoriaModel;
  use App\User;
  $users = User::all();
  $alumnos = User::where('acceso','=','2')->get();
  $profesores = User::where('acceso','=','1')->get();
  $administradores = User::where('acceso','=','0')->get();
  $categorias = CategoriaModel::all();
  $cursos = CursoModel::all();
@endphp

@section('title','ABM')

@section('content')

  <ul class="nav nav-tabs" id="myTab" role="tablist">
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
    <a class="nav-link" id="categorias-tab" data-toggle="tab" href="#categorias" role="tab" aria-controls="contact" aria-selected="false">Categorias</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre de Usuario</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($alumnos as $key => $value)
          <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->username}}</td>
            <td>{{$value->email}}</td>
            <td> <button class="btn btn-danger" name="button" >
            <a href="/abm?id={{$value->id}}&tipo=usuario&operacion=eliminar" style="color:white"> Eliminar </a> </button> </td>
            <td> <button class="btn btn-primary" name="button" >
            <a href="/abm?id={{$value->id}}&tipo=usuario&operacion=editar" style="color:white"> Editar </a> </button> </td>
            <td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#modalUsuario">Agregar</button>

  </div>
  <div class="tab-pane fade" id="administradores" role="tabpanel" aria-labelledby="profesores-tab">
    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre de Usuario</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>

          @foreach ($administradores as $key => $value)
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->username}}</td>
              <td>{{$value->email}}</td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="profesores" role="tabpanel" aria-labelledby="administradores-tab">

      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($profesores as $key => $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->username}}</td>
                <td>{{$value->email}}</td>
                <td> <button class="btn btn-danger" name="button" >
                <a href="/abm?id={{$value->id}}&tipo=usuario&operacion=eliminar" style="color:white"> Eliminar </a> </button> </td>
                <td> <button class="btn btn-primary" name="button" >
                <a href="/abm?id={{$value->id}}&tipo=usuario&operacion=editar" style="color:white"> Editar </a> </button> </td>
              </tr>
            @endforeach
        </tbody>
      </table>

      <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#modalUsuario">Agregar</button>
  </div>
  <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">

      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Lenguaje</th>
            <th>Precio</th>
            <th>Categoria</th>
            <th>Autor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cursos as $key => $value)
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->titulo}}</td>
              <td>{{$value->lenguaje}}</td>
              <td>{{$value->precio}}</td>
              <td>{{$value->categoria->nombre}}</td>
              <td>{{$value->creador->username}}</td>
              <td> <button class="btn btn-danger" name="button" >
              <a href="/abm?id={{$value->id}}&tipo=curso&operacion=eliminar" style="color:white"> Eliminar </a> </button> </td>
              <td> <button class="btn btn-primary" name="button" >
              <a href="/abm?id={{$value->id}}&tipo=curso&operacion=editar" style="color:white"> Editar </a> </button> </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <button type="button" class="btn btn-success" name="button">Agregar</button>

  </div>
  <div class="tab-pane fade" id="alumnos-cursos" role="tabpanel" aria-labelledby="alumnos-cursos-tab">
    <table class="table table-dark">
      <thead>
        <tr>
          <th>Curso</th>
          <th>Alumno</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cursos as $key => $value)
          @php
          @endphp
          <tr>
            <td>{{$value->titulo}}</td>
            @foreach ($value->alumno as $key => $alumno)
              <td>{{$alumno->username}}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="categorias" role="tabpanel" aria-labelledby="categorias-tab">
    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Categoria</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categorias as $key => $value)
          <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->nombre}}</td>
            <td> <button class="btn btn-danger" name="button" >
            <a href="/abm?id={{$value->id}}&tipo=categoria&operacion=eliminar" style="color:white"> Eliminar </a> </button> </td>
            <td> <button class="btn btn-primary" name="button" >
            <a href="/abm?id={{$value->id}}&tipo=categoria&operacion=editar" style="color:white"> Editar </a> </button> </td>
          </tr>
        @endforeach
      </tbody>

    </table>

    <button type="button" class="btn btn-success" name="button">Agregar</button>

  </div>

</div>



<!-- Modal Categoria-->
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
                <form class="" action="/abm/usuario" method="POST">
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
                    <div class="input-group mb-3">
                      <label for="acceso">Nivel de acceso:</label>
                      <br>
                      <select  name="acceso">
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
