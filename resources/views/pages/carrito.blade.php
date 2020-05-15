@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/carrito.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,900&display=swap" rel="stylesheet">
@endpush
@section('title','Carro')

@section('content')
  <section>
    <!--<div class="limpiar">
      <a href="{{url('/carritolimpiar')}}">Limpiar Carro</a>

    </div>-->
    <div class="container">
        @if(count($cursos)>0)
        <div class="row mt-4" id="lleno">
            <div class="col-md-8 cursos">
            @forelse ($cursos as $curso)
                <div class="curso border-top-0 border-bottom-0 mb-2">
                    <div class="item p-2">
                        <img class="img-center rounded" src="..\storage\img\cursos\{{$curso->foto_curso}}" alt="">
                    </div>
                    <div class="item-desc p-2">
                        <h5 class="font-weight-bold titulo ">{{$curso->titulo}}</h5>
                        <p class="desc">{{$curso->desc}}</p>
                    </div>
                    <div class="item text-center pt-4">
                        <p class=font-weight-bold>
                        Autor:<a href="#"> {{$curso->creador->username}}</a>
                        </p>
                        <p clasS=font-weight-bold>
                            Lenguaje: <a href="">{{$curso->lenguaje->nombreLenguaje}}</a>
                        </p>

                        <p >${{$curso->precio}}</p>
                    </div>

                    <a class="borrar-uno" cursoId="{{$curso->id}}" href="{{route('borrarUno',$curso->id)}}"><i class="fas fa-trash-alt"></i></a>
                </div>
            @empty
                <div>
                    <h1>No se encontraron los resultados</h1>
                </div>
            @endforelse
            </div>


            <div class="col-md-4 ">
                <div class="card border-top-0 border-bottom-0 sumario">
                    <div class="card-body">
                        <h4 class="text-center">Detalle total</h4>
                        <hr>
                        <?php $total=0;?>
                        @forelse($cursos as $curso)
                        <p class="text-center" cursoId="{{$curso->id}}">${{$curso->precio}}</p>
                        <?php $total+=$curso->precio;?>
                        @empty
                        <div>
                            <h1>No se encontraron los resultados</h1>
                        </div>
                        @endforelse
                        <hr>
                        <p>
                            <span class="font-weight-bold mr-5">TOTAL:</span ><span id="total" value="{{$total}}">$<?=$total?></span>
                            <a class="btn btn-danger ml-4" href="{{route('pagar')}}">Comprar</a>

                            <div>
                                <img class="img-center" src="{{ asset('img/merca.jpg') }}" alt="">
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id=vacio1 display="none">
            <h1>No hay productos en su carrito.</h1>
            <img src="{{ asset('img/mensajes/emptyCart.png')}}" alt="Carrito vacío" class="img-fluid">
        </div>
        @else
        <div id="vacio2">
            <h1>No hay productos en su carrito.</h1>
            <img src="{{ asset('img/mensajes/emptyCart.png')}}" alt="Carrito vacío" class="img-fluid">
        </div>
        @endif
    </div>
</div>
  </section>
@endsection

@section('scripting')
<script src="{{ asset('js/carrito.js') }}"></script>
@endsection
