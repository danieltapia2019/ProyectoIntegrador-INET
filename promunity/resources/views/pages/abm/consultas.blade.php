@extends('layout.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@php
  $currentPage = $consultas->currentPage(); //Página actual
  $maxPages = $currentPage + 3; //Máxima numeración de páginas
  $firstPage = 1; //primera página
  $lastPage = $consultas->lastPage(); //última página
  $nextPage = $currentPage+1; //Siguiente página
  $forwardPage = $currentPage-1; //Página anterior
  $consultas->setPath('');
@endphp
@section('title','ABM')

@section('content')
<div class="contenedor">
    @include('component.sidenav')
    <div class="contenido col-md-10">

        <div class="ordenamiento">
          <h5>Ordenar Por</h5>
          <form class="" action="/abm/consultas" method="GET">
            <div class="col-md-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Campo</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="atributo">
                  <option value="0">ID</option>
                  <option value="1">Nombre</option>
                  <option value="2">Email</option>
                  <option value="3">Telefono</option>
                  <option value="4">Fecha</option>
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

        <div class="card-columns">
            @forelse ($consultas as $consulta)
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title">{{$consulta->nombre}}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$consulta->consulta}}</p>
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    <p class="card-text">{{$consulta->email}}</p>
                    <p class="card-text">{{$consulta->created_at}}</p>
                </div>
                <div class="card-body">
                    <form action="{{ url('/abm/consultas/borrar') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{$consulta->id}}">
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            @empty
            <h2>No hay consultas que mostrar</h2>
            @endforelse
        </div>
        {{--$consultas->links()--}}

        <ul class="pagination nav-link">
                <!-- Botón para navegar a la primera página -->
                <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                        <a href="@if($currentPage>1){{$consultas->url($firstPage).$link}}@else{{$consultas->url($firstPage).$link}}@endif" class='btn'>Primera</a>
                </li>
                <!-- Botón para navegar a la página anterior -->
                <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                        <a href="@if($currentPage>1){{$consultas->url($forwardPage).$link}}@else{{$consultas->url($firstPage).$link}}@endif" class='btn'>«</a>
                </li>
                <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
                @for($x=$currentPage;$x<$maxPages;$x++)
                        @if($x <= $lastPage)
                        <li class="@if($x==$currentPage){{'active'}}@endif">
                                <a href="{{$consultas->url($x).$link}}" class='btn'>{{$x}}</a>
                        </li>
                        @endif
                @endfor
                <!-- Botón para navegar a la pagina siguiente -->
                <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                        <a href="@if($currentPage<$lastPage){{$consultas->url($nextPage).$link}}@else{{'#'}}@endif" class='btn'>»</a>
                </li>
                <!-- Botón para navegar a la última página -->
                <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                        <a href="@if($currentPage<$lastPage){{$consultas->url($lastPage).$link}}@else{{'#'}}@endif" class='btn'>Última</a>
                </li>
        </ul>
    </div>
</div>

@endsection
