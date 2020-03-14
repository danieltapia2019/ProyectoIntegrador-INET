@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/setting.css') }}">
@endpush

@section('title','Setting')

@section('content')
<section class="config" id="PageSetting">
    <h2 class="">Configuracion de la página</h2>
    <h4 class="mt-5 mb-3"><i class="fas fa-adjust"></i>Dark Mode</h4>
    <form action="/setting" method="POST" class="form-dark">
        @csrf
        <div class="form-check">
            @if( Cookie::get('theme')==='dark' )
            
            <input class="form-check-input" type="checkbox" value="light" id="lightMode" name="userPreference" required>
            <label class="form-check-label" for="lightMode">Light Mode</label>
            @else
            <input class="form-check-input" type="checkbox" value="dark" id="darkmode" name="userPreference" required>
            <label class="form-check-label" for="darkmode">Dark Mode</label>
            @endif
        </div>
        <div class="form-group mt-2 mb-5">
            <button class="btn btn-outline-primary" type="submit">Guardar</button>
        </div>
    </form>
    <p class="text-danger"><strong>*Advertencia</strong>, puede que algunas páginas no soporten el 'Modo Oscuro' <b>:| *</b></p>
</section>
{{-- {{ Crypt::decrypt(Cookie::get('theme'))}} --}}
@endsection
