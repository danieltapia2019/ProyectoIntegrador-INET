@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/pageError.css') }}">
@endpush
@section('title','Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-xs12">
            <h1>Parece que hubo un error :(</h1>
            <img src="{{ asset('img/mensajes/errorHandle.png')}}" alt="Error" class="img-fluid">
        </div>
        <div class="col-lg-4 col-md-12 col-xs12">
            <div class="row">
                <h1>Paginas disponibles</h1>
            </div>
            <div class="row">
                <div class="col-6"><a href="/home"><i class="fas fa-home mr-1"></i>Home</a></div>
                <div class="col-6"><a href="/faq"><i class="fas fa-info-circle mr-1"></i>About</a></div>
                <div class="col-6"><a href="/search"><i class="fas fa-search mr-1"></i>Busqueda</a></div>
                <div class="col-6"><a href="/carrito"><i class="fas fa-shopping-cart mr-1"></i>Carrito</a></div>
                @guest
                <div class="col-6"><a href="/login"><i class="fas fa-sign-in-alt mr-1"></i>Login</a></div>
                <div class="col-6"><a href="/register"><i class="fas fa-edit mr-1"></i>Register</a></div>
                @else 
                <div class="col-12"><a href="/perfil"><i class="fas fa-user-circle mr-1"></i>Perfil</a></div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripting')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
