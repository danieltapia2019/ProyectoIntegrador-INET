@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-CURSOS')

@section('content')

<div class="contenedor">
      @include('component.sidenav')
<div class="contenido-tabla col-md-10">
    <div class="ordenamiento">
      <h5>Ordenar Por</h5>
  <form class="" action="/abm/cursos" method="GET">
        <div class="col-md-12">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Campo</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="atributo">
              <option value="0">ID</option>
              <option value="1">Titulo</option>
              <option value="2">Lenguaje</option>
              <option value="3">Precio</option>
              <option value="4">Fecha de Creacion</option>
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
</form>
    <table class="table table-light mt-3 mb-5 table-desktop">
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
                <td><a href="/storage/img/cursos/{{$curso->foto_curso}}">Imagen</a></td>
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
                <td></td>
            </tr>
            @empty
            <h3 class="mt-5 mb-5">No hay Cursos :(</h3>
            @endforelse
        </tbody>
    </table>
    <table class="table table-light mt-3 mb-5  d-block d-sm-block d-md-none">

          <thead>
              <tr>
                  <th>ID</th>
                  <th>Titulo</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @forelse ($cursos as $key => $curso)
              <tr>
              <td>{{$curso->id}}</td>
              <td>{{$curso->titulo}}</td>
              <td> <button type="button" class="btn btn-primary propiedades" data-toggle="modal" data-target="#modalCurso" name="button" onclick="verPropiedades({{$curso}},this)">Propiedades</button> </td>
              </tr>
            @empty

            @endforelse
          </tbody>

    </table>
    {{$cursos->links()}}

                <a href="/perfil">
                <button type="button" class="btn btn-success btn-lg btn-block" name="button">Agregar</button>
                </a>
 </div>
</div>

<!-- Modal CURSO-->
<div class="modal fade" id="modalCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
              <p class="descripcion-mobile">Descripcion:</p>
              <hr>
              <h3 class="lenguaje-mobile">Lenguaje:</h3>
              <p class="imagen-mobile">Ver imagen</p>
              <p class="precio-mobile">Precio:</p>
              <p class="autor-mobile">Autor:</p>
              <p class="tipo-mobile">Tipo:</p>
              <p class="uso-mobile">Uso:</p>
                        <button type="button" onclick="" name="button" class="btn-delete btn btn-danger btn-lg btn-block delete-mobile">Eliminar</button>
                        <hr>
                        <a class="edit-mobile">
                            <button type="button" name="button" class="btn btn-primary btn-lg btn-block " >Editar</button>
                        </a>
            </div>
        </div>
    </div>
</div>
@endsection
