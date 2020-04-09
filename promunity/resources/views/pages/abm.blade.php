@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-GENERAL')

@section('content')
<div class="conteiner">
@include('component.sidenav')
  <div class="col-md-10">
      <div class="alert alert-primary" role="alert">
          <h1>
              <span class="badge badge-secondary"> <a href="/abm/usuarios" style="color:white;">Usuarios</a> </span>
              <span class="badge badge-secondary"> <a href="/abm/cursos" style="color:white;">Cursos</a> </span>
              <span class="badge badge-secondary"> <a href="/abm/cursos-alumnos" style="color:white;">Alumnos-Cursos</a> </span>
              <span class="badge badge-secondary"> <a href="/abm/tipos" style="color:white;">Tipos</a> </span>
              <span class="badge badge-secondary"> <a href="/abm/usos" style="color:white;">Usos</a> </span>
          </h1>
</div>
  </div>

</div>

@endsection
