@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush


@php
  $currentPage = $transacciones->currentPage(); //Página actual
  $maxPages = $currentPage + 3; //Máxima numeración de páginas
  $firstPage = 1; //primera página
  $lastPage = $transacciones->lastPage(); //última página
  $nextPage = $currentPage+1; //Siguiente página
  $forwardPage = $currentPage-1; //Página anterior
  $transacciones->setPath('');
@endphp

@section('title','Transacciones')

@section('content')
  <div class="contenedor">
  <div class="">
    @include('component.sidenav')
    </div>
    <div class="contenido-tabla col-md-10">
      <div class="ordenamiento">
        @if (count($transacciones) != 0)
        <h5>Ordenar Por</h5>
        <form class="" action="/abm/transacciones" method="GET">
          <div class="col-md-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Campo</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="atributo">
                <option value="0">ID</option>
                <option value="1">Nombre de usuario</option>
                <option value="2">Titulo del curso</option>
                <option value="3">Estado</option>
                <option value="4">Referencia</option>
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
        @endif
      </div>
      <hr>
      <table class="table table-desktop table-light mt-3 mb-5 transaccion">
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
          @forelse($transacciones as $tran)
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
          @empty
            <h3>No hay alumnos inscriptos</h3>
          @endforelse
        </tbody>
      </table>
<!-- Tabla Mobile -->
      <table class="table table-light mt-3 mb-5  d-block d-sm-block d-md-none">

            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
              @forelse ($transacciones as $key => $transaccion)
                <tr>
                <td>{{$transaccion->referencia}}</td>
                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTransaccion" name="button" onclick="verTransaccion({{$transaccion}},this)">Ver Propiedades</button> </td>

              @empty
                <h3>No hay Alumnos inscriptos</h3>
              @endforelse
            </tbody>

      </table>

      <ul class="pagination nav-link">
              <!-- Botón para navegar a la primera página -->
              <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                      <a href="@if($currentPage>1){{$transacciones->url($firstPage).$link}}@else{{$transacciones->url($firstPage).$link}}@endif" class='btn'>Primera</a>
              </li>
              <!-- Botón para navegar a la página anterior -->
              <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                      <a href="@if($currentPage>1){{$transacciones->url($forwardPage).$link}}@else{{$transacciones->url($firstPage).$link}}@endif" class='btn'>«</a>
              </li>
              <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
              @for($x=$currentPage;$x<$maxPages;$x++)
                      @if($x <= $lastPage)
                      <li class="@if($x==$currentPage){{'active'}}@endif">
                              <a href="{{$transacciones->url($x).$link}}" class='btn'>{{$x}}</a>
                      </li>
                      @endif
              @endfor
              <!-- Botón para navegar a la pagina siguiente -->
              <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                      <a href="@if($currentPage<$lastPage){{$transacciones->url($nextPage).$link}}@else{{'#'}}@endif" class='btn'>»</a>
              </li>
              <!-- Botón para navegar a la última página -->
              <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                      <a href="@if($currentPage<$lastPage){{$transacciones->url($lastPage).$link}}@else{{'#'}}@endif" class='btn'>Última</a>
              </li>
      </ul>
    </div>
  </div>


  <!-- Modal Transacion-->
  <div class="modal fade" id="modalTransaccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <hr>
                <p class="username-mobile">Alumno:</p>
                <p class="cursotitle-mobile">Curso:</p>
                <p class="state-mobile">Estado:</p>
                <button class="btn-habilitar" type="button" name="button"></button>
              </div>
          </div>
      </div>
  </div>
@endsection
