@extends('layout.app')

@section('css','css/pages/login.css')

@section('title','Registro')

@section('content')
<div class="container-fuild">
    <div class="modal-body">
        <form class="" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="username" class="form-control" aria-label="text"
                    placeholder="Nombre de usuario" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                </div>
                <input type="email" name="email" class="form-control" aria-label="email" placeholder="Ingrese email" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" aria-label="password" placeholder="Ingrese contraseña" required>
            </div>
            <button type="submit" class="btn btn-danger btn-lg btn-block my-3 ">Registrarse</button>
        </form>
    </div>
    @endsection
