@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-LENGUAJES')

@section('content')

<div class="contenedor">
  @include('component.sidenav')
  <div class="contenido-tabla col-md-8">
      <div class="ordenamiento">
        <h5>Ordenar Por</h5>
        <form class="" action="/abm/tipos" method="GET">
          <div class="col-md-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Campo</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="atributo">
                <option value="0">ID</option>
                <option value="1">Nombre de Lenguaje</option>
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
      <br>
      <table class="table table-light mt-1">
        <thead>
          <tr>
            <th>ID</th>
            <th>Lenguaje</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($lenguajes as $key => $lenguaje)
            <tr>
              <td>{{$lenguaje->id}}</td>
              <td>{{$lenguaje->nombreLenguaje}}</td>
              <td>
                  <div class="row">
                    <button type="button" onclick="borrarRegistro({{$lenguaje->id}},this,5)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                    <hr>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLenguaje" onclick="editarLenguaje({{$lenguaje}},this)">Editar</button>
                  </div>
              </td>
            </tr>
          @empty
            <h4>No hay Lenguajes :(</h4>
          @endforelse
        </tbody>
      </table>
      {{$lenguajes->links()}}
      <button type="button" class="btn btn-success btn-block btn-lg" name="button" data-toggle="modal"
      data-target="#modalLenguaje">Agregar</button>
  </div>
</div>



  <!-- Modal Lenguaje-->
  <div class="modal fade" id="modalLenguaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Lenguaje</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form class="lenguaje-form" action="" method="post">
                      {{csrf_field()}}
                      <div class="input-grup mb-3">
                          <input type="text" name="nlenguaje" class="form-control" placeholder="Lenguaje" maxlength="25" minlength="1" required>
                      </div>
                      <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-lenguaje">Agregar</button>
                  </form>
              </div>
          </div>
      </div>
  </div>


@endsection
