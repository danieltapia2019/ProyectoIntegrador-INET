@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/perfil.css') }}">
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
@endpush
@section('title','Perfil')

@section('content')
<header class="bienvenido">

    @if (session('message') == 'ERROR')
      <script type="text/javascript">
      window.addEventListener("load", function() {
      alert('NO SE PUDO ACTUALIZAR, YA EXISTE UN REGISTRO CON EL NOMBRE DE USUARIO Y/O EMAIL')
      })

      </script>
    @endif

    <div class="usuario" style="background-image: url({{ asset('/img/faqBienvenido.png') }});">
        <!--SideNav-->
        <div id="sideNavigation" class="sidenav">
            <ul style="color: white;">
                @if ($usuario->foto == null)
                <span id="fotoPerfilNav"> <img src="{{ asset('/img/perfil.jpg') }}" alt=""> </span>
                @else
                <span id="fotoPerfilNav"><img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}"
                        alt="{{$usuario->username}}"></span>
                @endif
                <p>STATUS:
                    @if ($usuario->acceso == 2)
                    <i class="fas fa-user"></i>
                    @endif
                    @if ($usuario->acceso == 1)
                    <i class="fas fa-user-tie"></i>
                    @endif
                    @if ($usuario->acceso == 0)
                    <i class="fas fa-users-cog" id="statusIcon"></i>
                    @endif
                </p>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <li>
                    @if ($usuario->acceso != 2)
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="nav-create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="false"  onclick="abrirDarUnCurso()">
                        <i class="fas fa-folder-plus"></i>
                        Dar un curso
                    </a>
                    <a class="nav-item nav-link" id="nav-created-tab" data-toggle="tab" href="#created" role="tab" aria-controls="created" aria-selected="false" onclick="abrirDarUnCurso()">Cursos Creados</a>
                  </div>
                    @endif
                </li>
                <li>
                    <a href="/setting" onclick="abrirConfig()">
                        <i class="fas fa-cogs"></i>Settings
                    </a>
                </li>
                <li>
                  @if ($usuario->acceso == 1)
                  @endif
                </li>
            </ul>
        </div>
        <nav class="topnav">
            <a href="#" onclick="openNav()">
                <i class="fas fa-bars"></i>
                {{-- <ion-icon name="menu" size="large">
                </ion-icon> --}}
            </a>
        </nav>
        <br>
        <h1>Bienvenido a su cuenta {{$usuario->username}}</h1>
    </div>
</header>
  <div class="tab container" id="UserProfileContent">
    <nav class="row">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="true">Mis datos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="cursos" aria-selected="false">Cursos Inscriptos</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#opinion" role="tab" aria-controls="opinion" aria-selected="false">¡Dejanos tu opinion!</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="editar" role="tabpanel" aria-labelledby="nav-home-tab">

    <form class="" action="/actualizarDatos" method="post">

          @csrf
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-user"></i></span>
              </div>
              <input type="text" name="username" class="form-control" placeholder="Nombre de usuario"
                  required value="{{$usuario->username}}">
          </div>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-envelope"></i></span>
              </div>
              <input type="email" name="email" class="form-control" aria-label="email"
                  placeholder="Ingrese email" required value="{{$usuario->email}}">
          </div>
          <div class="input-group mb-3 pass">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" class="form-control password" aria-label="password"
                  placeholder="Ingrese contraseña" id="password" required minlength="8">
              <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="button" name="button"
                      onclick="mostrarContrasena()">
                      <i name="" id="ojo" class="fas fa-eye-slash"></i>
                  </button>
              </div>
          </div>
          <div class="input-group mb-3 pass">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                  required autocomplete="new-password" placeholder="Confirmar contraseña nueva" minlength="8">
          </div>
          <button type="submit" class="btn btn-reg btn-lg btn-block my-3">Actualizar Datos</button>
    </form>

  </div>
  <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="contenedor">
        @forelse ($usuario->alumno_curso as $key => $curso)
        <div class="card-completo">
            <div class="card-body">
                <h5 class="card-title">{{$curso->titulo}}</h5>
                <p class="card-text">{{$curso->descripcion}}</p>
                <p>Lenguaje: {{$curso->lenguaje}}</p>
                <p>Precio: {{$curso->precio}} ARS</p>
                <p>Tipo: {{$curso->tipo->tipoNombre}}</p>
                <p>Uso: {{$curso->uso->usoNombre}}</p>
                <a href="/">Ir al curso</a>
            </div>
            {{--<img id="foto-curso" src="storage\img\cursos\{{$curso->foto_curso}}" class="card-img" alt="...">--}}
            <img id="foto-curso" src="{{$curso->foto_curso}}" alt="" class="card-img">
        </div>
        @empty
        <h3>No has comprado ningun curso</h3>
        @endforelse
    </div>
  </div>
  <div class="tab-pane fade" id="opinion" role="tabpanel" aria-labelledby="nav-contact-tab">
    <h2>Dejanos tu opinion</h2>
    <form class="opinion" action="/opinion" method="post">
      <textarea name="opinion" rows="8" cols="80" required>

      </textarea>
    </form>
    <button type="submit" name="button" class="btn btn-info btn-submit-opinion">Enviar tu opinion</button>
  </div>
  @if ($usuario->acceso != 2)
  <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="nav-create-tab">
        <form class="crearCurso" action="/perfil" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input style="display: none;" type="number" name="autor" value={{$usuario->id}}>
            <label for="titulo">Titulo: </label>
            <div class="input-group mb-3">
                <input type="text" name="titulo" class="form-control" placeholder="Ingrese titulo del curso" required
                    maxlength="30" minlength="10">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required></textarea>
            </div>
            <div class="fotoCurso">
                <label for="foto_curso">Foto:</label>
                <input type="file" class="form-control" name="foto_curso">
            </div>
            <br>
            <label for="precio">Precio:</label>
            <div class="input-group mb-3">
                <input type="number" name="precio" class="form-control" placeholder="Ingrese precio del curso" required
                    maxlength="1" minlength="10">
            </div>
            <label for="lenguaje">Lenguaje: </label>
            <div class="input-group mb-3">
                <input type="text" name="lenguaje" class="form-control" placeholder="Ingrese lenguaje del curso"
                    required maxlength="10" minlength="2">
            </div>

            <label for="tipo">Tipo: </label>
            <select name="tipo" class="custom-select" id="inputGroupSelect01" required>
                <option selected>Elegir tipo</option>

                @forelse ($tipos as $key => $tipo)
                <option value={{$tipo->id}}>{{$tipo->tipoNombre}}</option>
                @empty
                <option value="">No hay Tipos</option>
                @endforelse
            </select>
            <label for="uso">Uso: </label>
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

    <div class="tab-pane fade" id="created" role="tabpanel" aria-labelledby="nav-created-tab">

        <div class="contenedor">
            @forelse ($cursos as $key => $curso)
            <div class="card-completo">
                <div class="card-body">
                    <h5 class="card-title">{{$curso->titulo}}</h5>
                    <p class="card-text">{{$curso->descripcion}}</p>
                    <p>Lenguaje: {{$curso->lenguaje}}</p>
                    <p>Precio: {{$curso->precio}} ARS</p>
                    <p>Tipo: {{$curso->tipo->tipoNombre}}</p>
                    <p>Uso: {{$curso->uso->usoNombre}}</p>
                    <a href="/">Ir al curso</a>
                </div>
                {{--<img id="foto-curso" src="storage\img\cursos\{{$curso->foto_curso}}" class="card-img" alt="...">--}}
                <img id="foto-curso" src="{{$curso->foto_curso}}" alt="" class="card-img">
            </div>
            @empty
            <h3>No has comprado ningun curso</h3>
            @endforelse
        </div>
      </div>
    @endif
  </div>
  </div>

  </div>
</div>

<section class="opciones">

</section>

{{-- <script src="https://kit.fontawesome.com/918d19c8b4.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script> --}}
{{-- <script>
window.addEventListener("load", function() {

  // Tu código va acá!
});

</script> --}}

@endsection
@section('scripting')
    <script type="text/javascript" src="/js/main.js"></script>
@endsection
