@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush


@section('title','Editar Usuario')

@section('content')

<div class="editar-usuario">
  <h1>Bienvenio a editar usuario</h1>
  <form class="" action="/actualizar/usuario" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$usuario->id}}">
      <label for="username">Nombre de usuario nuevo</label>
      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-user"></i></span>
          </div>
          <input type="text" name="username" class="form-control" placeholder=""
              required value="{{$usuario->username}}">
      </div>

      <label for="email">Email nuevo</label>
      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-envelope"></i></span>
          </div>
          <input type="email" name="email" class="form-control" aria-label="email"
              placeholder="Ingrese email" required value="{{$usuario->email}}">
      </div>

      <label for="username">Contraseña nueva</label>
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
      <label for="username">Repetir Contraseña nueva</label>
      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
              required autocomplete="new-password" placeholder="Confirmar contraseña">
      </div>
        <label for="acceso">
          @if ($usuario->acceso = 2)
            Alumno
          @else
            Profesor
          @endif
        </label>

      <div class="input-group mb-3">
        <select  name="acceso">
          <option value="2">Alumno</option>
          <option value="1">Profesor</option>
          <option value="0">Administrador</option>
        </select>
      </div>
      <button type="submit" class="btn btn-reg btn-lg btn-block my-3 ">Actualizar</button>
  </form>

</div>



@endsection
