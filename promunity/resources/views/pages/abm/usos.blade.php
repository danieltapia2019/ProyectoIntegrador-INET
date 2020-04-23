@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@php
  $currentPage = $usos->currentPage(); //Página actual
  $maxPages = $currentPage + 3; //Máxima numeración de páginas
  $firstPage = 1; //primera página
  $lastPage = $usos->lastPage(); //última página
  $nextPage = $currentPage+1; //Siguiente página
  $forwardPage = $currentPage-1; //Página anterior
  $usos->setPath('');
@endphp
@section('title','ABM')

@section('content')
  <div class="contenedor row">
  <div class="col-md-2">
      @include('component.sidenav')
      </div>
    <div class="contenido-tabla col-md-10">
          <div class="ordenamiento">
            <h5>Ordenar Por</h5>
            <form class="" action="/abm/usos" method="GET">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Campo</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="atributo">
                    <option value="0">ID</option>
                    <option value="1">Uso Nombre</option>
                    <option value="2">Fecha de Creacion</option>
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
      <table class="table table-light mt-3 mb-5 usos">
        <thead>
          <tr>
            <th>ID</th>
            <th>Uso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($usos as $key => $uso)
            <tr>
              <td>{{$uso->id}}</td>
              <td>{{$uso->usoNombre}}</td>
              <td>
                <div class="row">
                  <button type="button" onclick="borrarRegistro({{$uso->id}},this,4)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUso" onclick="editarUso({{$uso}},this)">Editar</button>
                </div>
              </td>
            </tr>
          @empty
            <h3 class="mt-5 mb-5">No hay Uso :(</h3>
          @endforelse
        </tbody>

      </table>

  {{--$usos->links()--}}

  <ul class="pagination nav-link">
          <!-- Botón para navegar a la primera página -->
          <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                  <a href="@if($currentPage>1){{$usos->url($firstPage).$link}}@else{{$usos->url($firstPage).$link}}@endif" class='btn'>Primera</a>
          </li>
          <!-- Botón para navegar a la página anterior -->
          <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                  <a href="@if($currentPage>1){{$usos->url($forwardPage).$link}}@else{{$usos->url($firstPage).$link}}@endif" class='btn'>«</a>
          </li>
          <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
          @for($x=$currentPage;$x<$maxPages;$x++)
                  @if($x <= $lastPage)
                  <li class="@if($x==$currentPage){{'active'}}@endif">
                          <a href="{{$usos->url($x).$link}}" class='btn'>{{$x}}</a>
                  </li>
                  @endif
          @endfor
          <!-- Botón para navegar a la pagina siguiente -->
          <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                  <a href="@if($currentPage<$lastPage){{$usos->url($nextPage).$link}}@else{{'#'}}@endif" class='btn'>»</a>
          </li>
          <!-- Botón para navegar a la última página -->
          <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                  <a href="@if($currentPage<$lastPage){{$usos->url($lastPage).$link}}@else{{'#'}}@endif" class='btn'>Última</a>
          </li>
  </ul>
  <button type="button" class="btn btn-success btn-block btn-lg" name="button" data-toggle="modal"
  data-target="#modalUso">Agregar</button>
    </div>
  </div>

  <div class="modal fade" id="modalUso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar uso</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form class="uso-form" action="" method="post">
                      {{csrf_field()}}
                      <div class="input-grup mb-3">
                          <input type="text" name="snombre" class="form-control" placeholder="Uso" required>
                      </div>
                      <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-uso">Agregar</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
