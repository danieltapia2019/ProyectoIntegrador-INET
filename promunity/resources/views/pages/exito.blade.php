@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/exito.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,900&display=swap" rel="stylesheet">
@endpush
@section('metadatos')
<!--Token necesario para consultas al servidor mediante ajax-->
<meta name="csrf-token" content="{{csrf_token()}}"/>
@endsection
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
    <div class=" row mt-3">
        <div class=" cuerpo col-md-8">
            @foreach($carrito as $curso)
            @if($loop->iteration==4)
            @break
            @endif
            <div class=curso>
                <h5 class="font-weight-bold">{{$curso->titulo}}</h5>
                <img src="https://www.anerbarrena.com/wp-content/uploads/2016/04/html5.png" alt="">
                <a href="{{url('/curso/'.$curso->id)}}">Ir al curso</a>
            </div>
            @endforeach
        </div>
        <div class="col-md-4 recordatorio">
            <p class="pt-5">Recuerda que podras acceder a TODOS tus cursos desde tu perfil en la pestaña de cursos!</p>
            <a href="" class="btn btn-danger">Ver mis cursos</a>
        </div>
    </div>

    <div class="interesarte mt-3">
        <p class="texto">Otros cursos que podrian interesarte...</p>
    </div>






</div>


@endsection

@section('scripts')
<script src="{{ asset('js/carrito.js') }}"></script>
@endsection
