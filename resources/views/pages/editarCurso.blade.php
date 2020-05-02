@extends('layout.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush


@section('title','Editar Curso')

@section('content')
<div class="editar-curso">
  <form class="crearCurso" action="/actualizar/curso" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="id" value={{$curso->id}}>
      <label for="titulo">Titulo Nuevo: </label>
      <div class="input-group mb-3">
          <input type="text" name="titulo" class="form-control" required
              maxlength="100" minlength="10" value="{{$curso->titulo}}">
      </div>
      <div class="form-group">
          <label for="descripcion">Descripcion nueva:</label>
          <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required>
            {{$curso->desc}}
          </textarea>
      </div>
      <div class="fotoCurso">
          <img src="storage\img\cursos\{{$curso->foto_curso}}" alt="">
          <label for="foto_curso">Foto nueva:</label>
          <input type="file" class="form-control" name="foto_curso" accept="image/*">
      </div>
      <br>
      <label for="precio">Precio nuevo:</label>
      <div class="input-group mb-3">
          <input type="number" name="precio" class="form-control" value="{{$curso->precio}}" required>
      </div>

      <label for="autor">Cambiar Autor: </label>
      <select name="autor" class="custom-select" id="inputGroupSelect04" required>
        <option value={{$curso->creador->id}} selected>{{$curso->creador->username}} Autor Original</option>
        @forelse ($profesores as $key => $profesor)
        <option value={{$profesor->id}}>{{$profesor->username}}</option>
        @empty
        <option value="">No hay profesores</option>
        @endforelse
      </select>
      <label for="lenguaje">Lenguaje: </label>
      <select name="lenguaje" class="custom-select" id="inputGroupSelect01" required>
        <option value="{{$curso->lenguaje->id}}" selected>{{$curso->lenguaje->nombreLenguaje}}</option>
        @forelse ($lenguajes as $key => $lenguaje)
        <option value={{$lenguaje->id}}>{{$lenguaje->nombreLenguaje}}</option>
        @empty
        <option value="">No hay lenguajes</option>
        @endforelse
      </select>

      <label for="tipo" >Tipo: </label>
       <select name="tipo" class="custom-select" id="inputGroupSelect02" required>
          <option selected value={{$curso->tipo->id}}> {{$curso->tipo->tipoNombre}}</option>

          @forelse ($tipos as $key => $tipo)
          <option value={{$tipo->id}}>{{$tipo->tipoNombre}}</option>
          @empty
          <option value="">No hay Tipos</option>
          @endforelse
      </select>
      <label for="uso" >Uso: </label>
       <select name="uso" class="custom-select" id="inputGroupSelect03" required>
          <option selected value="{{$curso->uso->id}}">{{$curso->uso->usoNombre}}</option>
          @forelse ($usos as $key => $uso)
          <option value={{$uso->id}}>{{$uso->usoNombre}}</option>
          @empty
          <option value="">No hay Usos</option>
          @endforelse
      </select>
      <br>
      <hr>
      <button type="submit" name="button" class="btn btn-success btn-block btn-lg">Guardar</button>
  </form>
</div>

@endsection
