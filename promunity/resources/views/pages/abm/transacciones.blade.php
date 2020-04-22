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
      @else
      <h3 class="mt-5 mb-5">No hay Alumnos Inscriptos :(</h3>
      @endif
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
