@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@php
  $currentPage = $alumnos_cursos->currentPage(); //Página actual
  $maxPages = $currentPage + 3; //Máxima numeración de páginas
  $firstPage = 1; //primera página
  $lastPage = $alumnos_cursos->lastPage(); //última página
  $nextPage = $currentPage+1; //Siguiente página
  $forwardPage = $currentPage-1; //Página anterior
  $alumnos_cursos->setPath('');
@endphp
@section('title','ABM-CURSO-ALUMNO')

@section('content')
  <div class="contenedor">
    @include('component.sidenav')
    <div class="contenido col-md-10">
          <div class="ordenamiento">
            <h5>Ordenar Por</h5>
            <form class="" action="/abm/cursos-alumnos" method="GET">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Campo</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="atributo">
                    <option value="0">ID Curso</option>
                    <option value="1">Titulo del Curso</option>
                    <option value="2">Nombre de usuario</option>
                    <option value="3">ID Usuario</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Tipo</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect02" name="tipo">
                    <option value="0">Ascendente</option>
                    <option value="1">Descendente</option>
                  </select>
                </div>
              </div>
              <button type="submit" name="button" class="btn btn-dark btn-block">ORDENAR</button>
            </form>
          </div>
          <hr>
          <br>
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
              <td id="IDregistro">{{$alumno_curso->curso_id}}</td>
              <td>{{$alumno_curso->curso->titulo}}</td>
              <td>{{$alumno_curso->alumno->username}}</td>
              <td id="IDregistro">{{$alumno_curso->user_id}}</td>
            </tr>
          @empty
            <h3 class="mt-5 mb-5">No hay Alumnos Inscriptos :(</h3>
          @endforelse
        </tbody>
      </table>
      {{--$alumnos_cursos->links()--}}

      <ul class="pagination nav-link">
              <!-- Botón para navegar a la primera página -->
              <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                      <a href="@if($currentPage>1){{$alumnos_cursos->url($firstPage).$link}}@else{{$alumnos_cursos->url($firstPage).$link}}@endif" class='btn'>Primera</a>
              </li>
              <!-- Botón para navegar a la página anterior -->
              <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                      <a href="@if($currentPage>1){{$alumnos_cursos->url($forwardPage).$link}}@else{{$alumnos_cursos->url($firstPage).$link}}@endif" class='btn'>«</a>
              </li>
              <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
              @for($x=$currentPage;$x<$maxPages;$x++)
                      @if($x <= $lastPage)
                      <li class="@if($x==$currentPage){{'active'}}@endif">
                              <a href="{{$alumnos_cursos->url($x).$link}}" class='btn'>{{$x}}</a>
                      </li>
                      @endif
              @endfor
              <!-- Botón para navegar a la pagina siguiente -->
              <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                      <a href="@if($currentPage<$lastPage){{$alumnos_cursos->url($nextPage).$link}}@else{{'#'}}@endif" class='btn'>»</a>
              </li>
              <!-- Botón para navegar a la última página -->
              <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                      <a href="@if($currentPage<$lastPage){{$alumnos_cursos->url($lastPage).$link}}@else{{'#'}}@endif" class='btn'>Última</a>
              </li>
      </ul>
    </div>
  </div>
@endsection
