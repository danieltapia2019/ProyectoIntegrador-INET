@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM')

@section('content')

<div class="conteiner row">
<div class="col-md-2">
    @include('component.sidenav')
    </div>
<div class="contenido col-md-10">
    <a href="/perfil">
      <button type="button" class="btn btn-success mb-3" name="button">Agregar</button>
    </a>

    <hr>
<h5>Ordenar Por</h5>
<form class="" action="/abm/cursos" method="GET">
  <div class="row">
    <select class="" name="atributo">
      <option value="id">ID</option>
      <option value="titulo">Titulo</option>
      <option value="lenguaje">Lenfuaje</option>
      <option value="precio">precio</option>
    </select>
    <br>
    <select class="" name="tipo">
      <option value="asc">Ascendente</option>
      <option value="desc">Descendente</option>
    </select>
  </div>
  <button type="submit" name="button" class="btn btn-dark">Ordenar</button>
</form>
    <table class="table table-light mt-3 mb-5">
        <thead>
            <tr>
                <th id="IDregistro">ID</th>
                <th>Titulo</th>
                <th>Lenguaje</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th>Uso</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cursos as $key => $curso)
            <tr>
                <th id="IDregistro">{{$curso->id}}</th>
                <td>{{$curso->titulo}}</td>
                <td>{{$curso->lenguaje->nombreLenguaje}}</td>
                <td><a href="/storage/img/cursos/{{$curso->foto_curso}}">Ver imagen</a></td>
                <td>{{$curso->precio}}</td>
                <td>{{$curso->tipo->tipoNombre}}</td>
                <td>{{$curso->uso->usoNombre}}</td>
                <td>{{$curso->creador->username}}</td>

                <td>
                    <div class="row">
                        <button type="button" onclick="borrarRegistro({{$curso->id}},this,2)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                        <hr>
                        <button class="btn btn-primary" name="button">
                            <a href="/editar/curso/{{$curso->id}}" style="color:white"> Editar </a>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
            @endforelse
            {{$cursos->links()}}
        </tbody>
    </table>
 </div>
</div>
@endsection
