@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/exito.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,900&display=swap" rel="stylesheet">
@endpush
@section('title','Carro')

@section('content')
<div class="container">
    <div class="titulo">
        <p><img src="{{asset('img/exito.png')}}" alt="Compra exitosa">¡¡¡GRACIAS POR TU COMPRA!!!</p>
    </div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Los cursos comprados estarán habilitados en un rango de 5 a 10 minutos.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <p class="texto">Compraste...</p>
    <div class=" row mt-3 mb-4">
        <div class=" cuerpo col-md-8">
            @foreach($carrito as $curso)
            @if($loop->iteration==4)
            @break
            @endif
            <div class=curso>
                <h5 class="font-weight-bold">{{$curso->titulo}}</h5>
                <img src="..\storage\img\cursos\{{$curso->foto_curso}}" alt="">
                <a href="{{url('/curso/'.$curso->id)}}">Ir al curso</a>
            </div>
            @endforeach
        </div>
        <div class="col-md-4 recordatorio">
            <p class="pt-5">Recuerda que podras acceder a TODOS tus cursos desde tu perfil en la pestaña de cursos!</p>
            <a href="/perfil" class="btn btn-danger">Ir a mi perfil</a>
        </div>
    </div>






</div>


@endsection

@section('scripting')
<script src="{{ asset('js/carrito.js') }}"></script>
@endsection
