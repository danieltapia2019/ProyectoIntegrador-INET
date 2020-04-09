@extends('layout.admin')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM-CURSO-ALUMNO')

@section('content')
  <div class="conteiner">
    @include('component.sidenav')
    <div class="contenido col-md-10">
      <table class="table table-light mt-3 mb-5 usos">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($cursos as $key => $curso)
            <tr>
              @forelse ($curso->alumno as $key => $alumno)
                <td>{{$curso->titulo}}</td>
                <td>{{$alumno->username}}</td>
              @empty
              @endforelse
            </tr>
          @empty

            <h3 class="mt-5 mb-5">No hay Alumnos Inscriptos :(</h3>
          @endforelse
        </tbody>

      </table>
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
