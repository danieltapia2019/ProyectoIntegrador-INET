@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush


@section('title','Editar Curso')

@section('content')
<div class="editar-curso">
  <form class="crearCurso" action="/actualizar/curso" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$curso->id}}">
      <input style="display: none;" type="number" name="autor" value={{auth()->user()->id}}>
      <label for="titulo" placeholder="{{$curso->titulo}}">Titulo Nuevo: </label>
      <div class="input-group mb-3">
          <input type="text" name="titulo" class="form-control" placeholder="Ingrese titulo del curso" required
              maxlength="100" minlength="10">
      </div>
      <div class="form-group">
          <label for="descripcion">Descripcion nueva:</label>
          <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required placeholder="{{$curso->desc}}"></textarea>
      </div>
      <div class="fotoCurso">
          <img src="storage\img\cursos\{{$curso->foto_curso}}" alt="">
          <label for="foto_curso">Foto nueva:</label>
          <input type="file" class="form-control" name="foto_curso" >
      </div>
      <br>
      <label for="precio">Precio nuevo:</label>
      <div class="input-group mb-3">
          <input type="number" name="precio" class="form-control" placeholder="{{$curso->precio}}" required>
      </div>
      <label for="lenguaje">Lenguaje: </label>
      <div class="input-group mb-3">
          <input type="text" name="lenguaje" class="form-control" placeholder="{{$curso->lenguaje}}"
              required maxlength="50" minlength="2">
      </div>

      <label for="tipo" >Tipo: </label>
       <select name="tipo" class="custom-select" id="inputGroupSelect01" required>
          <option selected>Elegir tipo</option>

          @forelse ($tipos as $key => $tipo)
          <option value={{$tipo->id}}>{{$tipo->tipoNombre}}</option>
          @empty
          <option value="">No hay Tipos</option>
          @endforelse
      </select>
      <label for="uso" >Uso: </label>
       <select name="uso" class="custom-select" id="inputGroupSelect01" required>
          <option selected>Elegir uso</option>
          @forelse ($usos as $key => $uso)
          <option value={{$uso->id}}>{{$uso->usoNombre}}</option>
          @empty
          <option value="">No hay Usos</option>
          @endforelse
      </select>
      <br>
      <button type="submit" name="button" class="btn btn-success">Guardar</button>
  </form>
</div>

@endsection
