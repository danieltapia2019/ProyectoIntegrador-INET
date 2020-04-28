@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/curso.css') }}">
@endpush

@section('title','Cursos')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{$curso->foto_curso}}" class="card-img" alt="{{ $curso->titulo }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $curso->titulo }}</h5>
                            <p class="card-text">{{ $curso->desc}}</p>
                            <p class="card-text"><small class="text-muted">{{ $curso->updated_up}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-10 col-md-12 col-xs-12">
            {{-- foreach para cada elemento(*material) del curso --}}
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Material del cursado</div>
                <div class="card-body text-dark">
                    <h5 class="card-title">Lorem ipsum</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel praesentium sed molestiae, ut temporibus beatae. Eum, est reprehenderit facilis praesentium consequatur odio, sint tempore sapiente dolorum ipsum unde ea officia!.</p>
                </div>
                <div class="card-footer text-muted">
                    <button disabled="disabled" class="btn btn-primary btn-block">Descargar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripting')

@endsection
