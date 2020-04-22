@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','Transacciones')

@section('content')
  <div class="conteiner row">
  <div class="col-md-2">
    @include('component.sidenav')
    </div>
    <div class="contenido col-md-10">
    @if($transacciones)
      <table class="table table-light mt-3 mb-5 usos">
        <thead>
          <tr>
            <th>Referencia</th>
            <th>Estado</th>
            <th>Alumno</th>
            <th>Curso</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transacciones as $tran)
            <tr>
                <td>{{$tran->referencia}}</td>
                <td id="{{$tran->id}}">
                    @if($tran->estado==1)
                    Pagado
                    @else
                    En proceso
                    @endif
                </td>
                <td>{{$tran->usuario->username}}</td>
                <td>{{$tran->curso->titulo}}</td>
                <td>
                    @if($tran->estado==0)
                    <button tranId="{{$tran->id}}"class="btn btn-success activar" href="{{route('activarCurso',$tran->id)}}">Habilitar</button>
                    @else
                    <button class="btn btn-danger" disabled=true>Habilitar</button>
                    @endif
                </td>
            </tr>


          @endforeach
        </tbody>
      </table>
<<<<<<< HEAD:promunity/resources/views/pages/abm/transacciones.blade.php
      @else
      <h3 class="mt-5 mb-5">No hay Alumnos Inscriptos :(</h3>
      @endif
    </div>
  </div>
=======
      {{--$alumnos_cursos->links()--}}
>>>>>>> 8cfa3e0cbf4faa86c12f0db40463b83154b92951:promunity/resources/views/pages/abm/cursos_alumnos.blade.php

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
