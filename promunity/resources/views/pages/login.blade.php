@extends('layout.app')

@section('css','css/pages/login.css')

@section('title','Login')

@section('content')
<div class="container-fuild">
    <div class="modal-body">
        <form action="loguear.php" method="post" class="loguearse">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                </div>
                <input type="email" name="email" class="form-control" aria-label="email" placeholder="Ingrese email"
                    required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" aria-label="password"
                    placeholder="Ingrese contraseña" required maxlength="20" minlength="6">
            </div>
            <p>
                <input type="checkbox" name="" value=""> Recordarme</p>
            <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Iniciar Sesión</button>
        </form>
        <p class="text-center"> <a href="#">¿Has olvidado tu contraseña? </a></p>
        <p class="text-center mt-3">¿No tienes cuenta?<button class="btn btn-success my-2 my-sm-0  bg-ligth border-0 register" data-toggle="modal" data-target="#modalRegistro">Registrate</button>
        </p>
    </div>
    @endsection
