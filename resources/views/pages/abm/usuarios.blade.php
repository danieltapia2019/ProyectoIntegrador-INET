@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@php

$currentPage = $usuarios->currentPage(); //Página actual
$maxPages = $currentPage + 3; //Máxima numeración de páginas
$firstPage = 1; //primera página
$lastPage = $usuarios->lastPage(); //última página
$nextPage = $currentPage+1; //Siguiente página
$forwardPage = $currentPage-1; //Página anterior
$usuarios->setPath('');
@endphp

@section('title','ABM')

@section('content')
  <div class="contenedor">
      <div class="">
      @include('component.sidenav')
      </div>
    <div class="contenido-tabla col-md-10">
      <div class="ordenamiento">
        @if (count($usuarios) != 0)
        <h5>Ordenar Por</h5>
        <form class="" action="/abm/usuarios" method="GET">
          <div class="col-md-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Campo</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="atributo">
                <option value="0">ID</option>
                <option value="1">Nombre de usuario</option>
                <option value="2">Email</option>
                <option value="3">Acceso</option>
                <option value="4">Fecha de Creacion</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect02">Tipo</label>
              </div>
              <select class="custom-select" id="inputGroupSelect02" name="tipo">
                <option value="0">Ascendente</option>
                <option value="1">Descendente</option>
              </select>
            </div>
          </div>
          <button type="submit" name="button" class="btn btn-dark btn-block">ORDENAR</button>
        </form>
        @endif
      </div>
      <table class="table table-light mt-1 usuario">
          <thead>
              <tr>
                  <th id="abmUser">ID</th>
                  <th>Nombre de Usuario</th>
                  <th id="abmUser">Email</th>
                  <th id="abmUser">Acceso</th>
                  <th id="abmUser">Imagen</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              @forelse ($usuarios as $key => $usuario)
              <tr>
                  <td id="abmUser">{{$usuario->id}}</td>
                  <td>{{$usuario->username}}</td>
                  <td id="abmUser">{{$usuario->email}}</td>
                  @if ($usuario->acceso == 2)
                  <td id="abmUser">Alumno</td>
                  @elseif ($usuario->acceso == 1)
                  <td id="abmUser">Profesor</td>
                  @else
                  <td id="abmUser">Admin</td>
                  @endif
                  @if ($usuario->foto != null)
                  <td id="abmUser"><a href="/storage/img/avatar/{{$usuario->foto}}">Ver Imagen</a> </td>
                  @else
                  <td id="abmUser">Nulo</td>
                  @endif
                  @if ($usuario->acceso != 0)
                    <td>
                        <div class="row">
                           <button type="button" onclick="borrarRegistro({{$usuario->id}},this,1)" name="button" class="btn-delete btn btn-danger">Borrar</button>
                            <hr>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario" onclick="editarUsuario({{$usuario}},this)">Editar</button>
                        </div>
                    </td>
                  @else
                    <td>No hay acciones</td>
                  @endif
              </tr>
              @empty
              <h3 class="mt-5 mb-5">No hay Usuarios :(</h3>
              @endforelse
          </tbody>
      </table>
        {{-- $usuarios->links() --}}
        <ul class="pagination nav-link">
                <!-- Botón para navegar a la primera página -->
                <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                        <a href="@if($currentPage>1){{$usuarios->url($firstPage).$link}}@else{{$usuarios->url($firstPage).$link}}@endif" class='btn'>Primera</a>
                </li>
                <!-- Botón para navegar a la página anterior -->
                <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                        <a href="@if($currentPage>1){{$usuarios->url($forwardPage).$link}}@else{{$usuarios->url($firstPage).$link}}@endif" class='btn'>«</a>
                </li>
                <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
                @for($x=$currentPage;$x<$maxPages;$x++)
                        @if($x <= $lastPage)
                        <li class="@if($x==$currentPage){{'active'}}@endif">
                                <a href="{{$usuarios->url($x).$link}}" class='btn'>{{$x}}</a>
                        </li>
                        @endif
                @endfor
                <!-- Botón para navegar a la pagina siguiente -->
                <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                        <a href="@if($currentPage<$lastPage){{$usuarios->url($nextPage).$link}}@else{{'#'}}@endif" class='btn'>»</a>
                </li>
                <!-- Botón para navegar a la última página -->
                <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                        <a href="@if($currentPage<$lastPage){{$usuarios->url($lastPage).$link}}@else{{'#'}}@endif" class='btn'>Última</a>
                </li>
        </ul>

          <button type="button" class="btn btn-success mb-3 btn-agregar btn-block btn-lg" name="button" data-toggle="modal"
              data-target="#modalUsuario">AGREGAR</button>
    </div>

</div>


<!-- Modal Crear Usuario-->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user-form" action="" method="POST">
                    @csrf
                    <div class="input-group mb-3 modal-username">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <div class="modal-username">
                          <input type="text" name="username" class="form-control" placeholder="Nombre de usuario"
                              required>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <div class="modal-email">
                          <input type="email" name="email" class="form-control" aria-label="email"
                              placeholder="Ingrese email" required>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <div class="modal-pass">
                          <input type="password" name="password" class="form-control password" aria-label="password"
                              placeholder="Ingrese contraseña" id="password" required minlength="8">
                        </div>
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
                        <div class="modal-pass-confirm">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                              required autocomplete="new-password" placeholder="Confirmar contraseña" minlength="8">
                        </div>
                    </div>
                    <label for="acceso">Nivel de acceso:</label>
                    <div class="input-group mb-3 modal-acceso">
                        <select name="acceso">
                            <option value="2">Alumno</option>
                            <option value="1">Profesor</option>
                            <option value="0">Administrador</option>
                        </select>
                    </div>
                    <button type='submit' class='btn btn-success btn-reg btn-lg btn-block my-3 btn-submit-user'>Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
