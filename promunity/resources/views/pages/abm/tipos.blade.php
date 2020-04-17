@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-TIPOS')

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
                  <option value="1">Tipo Nombre</option>
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
      <table class="table table-light mt-1 tipos">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tipos as $key => $tipo)
            <tr>
              <td>{{$tipo->id}}</td>
              <td>{{$tipo->tipoNombre}}</td>
              <td>
                <div class="row">
                  <button type="button" onclick="borrarRegistro({{$tipo->id}},this,3)" name="button" class="btn-delete btn btn-danger">Eliminar</button>
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipo" onclick="editarTipo({{$tipo}},this)">Editar</button>
                </div>
              </td>
            </tr>
          @empty
            <h3 class="mt-5 mb-5">No hay Tipo :(</h3>
          @endforelse
        </tbody>
      </table>
      {{$tipos->links()}}
      <button type="button" class="btn btn-success btn-block btn-lg" name="button" data-toggle="modal"
      data-target="#modalTipo">Agregar</button>
    </div>
  </div>

  <!-- Modal Tipo-->
  <div class="modal fade" id="modalTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar tipo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form class="tipo-form" action="" method="post">
                      {{csrf_field()}}
                      <div class="input-grup mb-3">
                          <input type="text" name="tnombre" class="form-control" placeholder="Tipo" required>
                      </div>
                      <button type="submit" class="btn btn-reg btn-lg btn-block my-3 btn-submit-tipo">Agregar</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
