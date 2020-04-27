@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-GENERAL')

@section('content')
<div class="contenedor">
    <div class="">
        @include('component.sidenav')
    </div>
    <div class="col-md-10 container">
        <div class="wrapper user">
            <div class="icon" id="i-user">
                <i class="fas fa-user"></i>
            </div>
            <div class="content">
                <p>{{$totales[1]}}</p>
            </div>
        </div>
        <div class="wrapper file">
            <div class="icon" id="i-curso">
                <i class="fas fa-file-video"></i>
            </div>
            <div class="content">
                <p>{{$totales[0]}}</p>
            </div>
        </div>
        <div class="wrapper eye">
            <div class="icon" id="i-view">
                <i class="fas fa-eye"></i>
            </div>
            <div class="content">
                <p>{{$totales[2]}}</p>
            </div>
        </div>

        <div class="abm-directions-panel">
            <button class="btn btn-secondary" onclick="location.href = '/abm/usuarios'">Usuarios</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/cursos'">Cursos</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/transacciones'">Transacciones</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/tipos'">Tipo</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/usos'">Uso</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/consultas'">Consultas</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/lenguajes'">Lenguajes</button>
        </div>
    </div>

</div>



<script>
  $(window).resize(function () {
      if( window.matchMedia("(max-width: 900px)") ){
        alert('Este sitio no esta optimizado para su dispositivos');
      }
  })
</script>
@endsection
