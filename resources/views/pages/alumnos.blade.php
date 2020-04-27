@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/perfil.css') }}">
@endpush


@section('title','ALUMNOS-'.$curso->id)

@section('content')
<div class="">
  <div class="card-alumno">
      <div class="card-body">
          <h5 class="card-title">{{$curso->titulo}}</h5>
          <p class="card-text">{{$curso->descripcion}}</p>
          <p>Lenguaje: {{$curso->lenguaje->nombreLenguaje}}</p>
          <p>Precio: {{$curso->precio}} ARS</p>
          <p>Tipo: {{$curso->tipo->tipoNombre}}</p>
          <p>Uso: {{$curso->uso->usoNombre}}</p>
          <p><a href="/">Ir al curso</a></p>
          <p><a href="/alumnos/curso/{{$curso->id}}">Ver Alumnos</a></p>
          <p>Cantidad de Alumnos: {{count($alumnos)}}</p>
          @if (auth()->user()->acceso == 0)
          <p>Autor: {{$curso->creador->username}}</p>
          <p> <a href="/admin/abm">Volver Al ABM GENERAL</a> </p>
          @endif
      </div>
  </div>
  <div class="alumnos">
    <table class="table">
      <thead>
        <tr>
          <td>Usuario</td>
          <td>Email</td>
        </tr>
      </thead>
      <tbody>
        @forelse ($alumnos as $key => $alumno)
        <tr>
          <td>{{$alumno->username}}</td>
          <td>{{$alumno->email}}</td>
        </tr>
        @empty
        <h4>No hay alumnos inscriptos</h4>
        @endforelse
      </tbody>
    </table>
    {{$alumnos->links()}}

  </div>
</div>




@endsection
