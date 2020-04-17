@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-CURSO-ALUMNO')

@section('content')
  <div class="contenedor">
    @include('component.sidenav')
    <div class="contenido col-md-10">
      <table class="table table-light mt-3 mb-5 usos">
        <thead>
          <tr>
            <th id="IDregistro">Curso ID</th>
            <th>Titulo</th>
            <th>Usuario</th>
            <th id="IDregistro">ID usuario</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($alumnos_cursos as $key => $alumno_curso)
            <tr>
              <td id="IDregistro">{{$alumno_curso->curso->id}}</td>
              <td>{{$alumno_curso->curso->titulo}}</td>
              <td>{{$alumno_curso->alumno->username}}</td>
              <td id="IDregistro">{{$alumno_curso->alumno->id}}</td>
            </tr>
          @empty
            <h3 class="mt-5 mb-5">No hay Alumnos Inscriptos :(</h3>
          @endforelse
        </tbody>
      </table>
      {{$alumnos_cursos->links()}}
    </div>
  </div>
@endsection
