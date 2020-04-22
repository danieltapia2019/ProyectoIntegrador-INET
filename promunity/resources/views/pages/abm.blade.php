@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-GENERAL')

@section('content')
<div class="container-fuild row">
    <div class=col-md-2>
    @include('component.sidenav')
    </div>
    <div class="col-md-10 container">
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

        <div class="abm-directions-panel">
            <button class="btn btn-secondary" onclick="location.href = '/abm/usuarios'">Usuarios</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/cursos'">Cursos</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/transacciones'">Transacciones</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/tipos'">Tipo</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/usos'">Uso</button>
            <button class="btn btn-secondary" onclick="location.href = '/abm/consultas'">Consultas</button>
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
