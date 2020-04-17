@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-GENERAL')

@section('content')
<div class="contenedor">
    @include('component.sidenav')
    <div class="row contenido-tabla" id="abm-home">
        <div class="wrapper">
            <div class="icon" id="i-user"><i class="fas fa-user"></i></div>
            <div class="content">
                <h1 class="mt-1">Usuarios</h1>
                <p><b>Total: </b><span class="badge badge-dark">{{$totales[1]}}</span></p>
            </div>
        </div>
        <div class="wrapper">
            <div class="icon" id="i-curso"><i class="fas fa-file-video"></i></div>
            <div class="content">
                <h1 class="mt-1">Cursos</h1>
                <p><b>Total: </b><span class="badge badge-dark">{{$totales[0]}}</span></p>
            </div>
        </div>
        <div class="wrapper">
            <div class="icon" id="i-view"><i class="fas fa-eye"></i></div>
            <div class="content">
                <h1 class="mt-1">Views</h1>
                <p><b>Total: </b><span class="badge badge-dark">{{$totales[2]}}</span></p>
            </div>
        </div>
        <div class="list-group col-md-10 listaABM">
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-primary" onclick="location.href = '/abm/usuarios'">USUARIOS</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-secondary" onclick="location.href = '/abm/cursos'">CURSOS</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-success" onclick="location.href = '/abm/cursos-alumnos'">USUARIO-CURSO</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-danger" onclick="location.href = '/abm/tipos'">TIPOS</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-warning" onclick="location.href = '/abm/usos'">USOS</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-info" onclick="location.href = '/abm/consultas'">CONSULTAS</button>
            <button class="btn btn-secondary list-group-item list-group-item-action list-group-item-light" onclick="location.href = '/abm/lenguajes'">LENGUAJES</button>
          </div>
    </div>

    {{--
    <div class="abm-directions-panel">
      <button class="btn btn-secondary" onclick="location.href = '/abm/usuarios'">Usuarios</button>
      <button class="btn btn-secondary" onclick="location.href = '/abm/cursos'">Cursos</button>
      <button class="btn btn-secondary" onclick="location.href = '/abm/cursos-alumnos'">Usuario-Cursos</button>
      <button class="btn btn-secondary" onclick="location.href = '/abm/tipos'">Tipo</button>
      <button class="btn btn-secondary" onclick="location.href = '/abm/usos'">Uso</button>
      <button class="btn btn-secondary" onclick="location.href = '/abm/consultas'">Consultas</button>
    </div>
    --}}
</div>

<script>
/*
  $(window).resize(function () {
      if( window.matchMedia("(max-width: 900px)") ){
        alert('Este sitio no esta optimizado para su dispositivos');
      }
  })*/
</script>
@endsection
