<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\Transaccion;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
class CarritoController extends Controller
{
  /**
   *
   */
  public function mostrarCarrito(Request $request){
    $cursos = [];
    if($request->session()->has('carrito')){
      $cursos=$request->session()->get('carrito');
    }
    $vac=compact('cursos');

    return view('pages.carrito',$vac);
  }

  /**
   *
   */
  public function agregarAlCarrito($id,Request $request){
    if($request->ajax()){
        $curso=CursoModel::find($id);
        //verifico que el que quiera agregar al carrito no sea un curso propio
        if(Auth::user()->id == $curso->creador->id){
            return response()->json([
                "mensaje"=>"No se puede agregar al carrito un curso propio."
            ]);

        }
        //esto es por si es el primer producto a agregar, se instancia el carrito en session
        else if($request->session()->has('carrito') == false){
            session(['carrito'=>[]]);
            $request->session()->push('carrito',$curso);
        }
        //si no es el primer producto quiere decir que el carrito ya esta instanciado, solo agregamos
        else{
            $cursos=$request->session()->get('carrito');
            //chequeo que el curso no se repita en el carrito
            foreach($cursos as $crso){
                if($crso->id == $curso->id){
                    return response()->json([
                        "mensaje"=>"Este curso ya está en su carrito."
                    ]);
                }
            }
            //verifico que el usuario no tenga este curso ya disponible para no volverlo a comprar
            foreach($curso->alumno as $usuario){
                if($usuario->id == Auth::user()->id){
                    return response()->json([
                        "mensaje"=>"Ya dispones de este curso."
                    ]);
                }
            }
            $request->session()->push('carrito',$curso);
        }
        return response()->json([
            "curso"=>$curso->alumno,
            "mensaje"=>"Agregado al carrito correctamente."
        ]);
    }
  }

  /**
   *
   */
  public function limpiarCarrito(Request $request){
    if ($request->session()->exists('carrito')){
        session(['carrito'=>[]]);
    }
    $cursos=[];
    return view('pages.carrito',compact('cursos'));
  }
  public function borrarUno(Request $request, $id){
    if($request->ajax()){
        $precio=CursoModel::find($id)->precio;
        $carro=$request->session()->get('carrito');
        for($i=0;$i<count($carro);$i++){
            if($carro[$i]->id == $id){
                array_splice($carro,$i,1);
            break;
            }
        }
        $request->session()->forget('carrito');
        session(['carrito'=> $carro]);
        return response()->json([
            "mensaje"=>"Eliminado del carro correctamente",
            "precio" =>$precio

        ]);
    }
}
public function pagar(Request $request,Faker $faker){
  $carrito=$request->session()->get('carrito');
  $transacciones=[];
  foreach($carrito as $p){
      $transaccion=new Transaccion();
      $transaccion->referencia=$p->id.$faker->hexcolor.Auth::user()->id;
      $transaccion->estado=0;   //0=en proceso , 1=listo
      $transaccion->user_id=Auth::user()->id;
      $transaccion->curso_id=$p->id;
      $transaccion->save();
  }

  $vac=compact('carrito');
  $this->limpiarCarrito($request);


  return view('pages.exito',$vac);
}
}
?>
