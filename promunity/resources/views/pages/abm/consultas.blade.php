@extends('layout.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/abm.css') }}">
@endpush

@section('title','ABM')

@section('content')
<div class="conteiner row">
<div class="col-md-2">
    @include('component.sidenav')
    </div>
    <div class="contenido col-md-10">
        <div class="card-columns">
            @forelse ($consultas as $consulta)
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title">{{$consulta->nombre}}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$consulta->consulta}}</p>
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    <p class="card-text">{{$consulta->email}}</p>
                </div>
                <div class="card-body">
                    <form action="{{ url('/abm/consultas/borrar') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{$consulta->id}}">
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            @empty
            <h2>No hay consultas que mostrar</h2>
            @endforelse
        </div>
    </div>
</div>

@endsection
