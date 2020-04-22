@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
@endpush

@section('title','Registro')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                              <div class="input-group">
                              <div class="input-group-append">
                                  <button class="btn btn-outline-primary" type="button" name="button"  onclick="mostrarContrasena()">
                                      <i name="eye" id="ojo" class="fas fa-eye"></i>
                                  </button>
                              </div>
                                <input id="password" type="password" class="form-control password " name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                                               {{----}}
                              <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto perfil') }}</label>
                              <div class="col-md-6">
                                  <input type="file" id="file-input"  class="form-control" name="foto" data-max-size="2048" accept="image/*">
                                  <br />
                                  <img id="imgSalida" class="rounded-circle mx-2" src="/img/perfil.jpg" />
                            </div>
                       </div>

                        {{-- <div class="form-group row">

                            <div class="col-md-6">
                                <input id="password-confirm" type="hidden" class="form-control" name="access" value="2">
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/main.js">
    </script>
</div>
@endsection
