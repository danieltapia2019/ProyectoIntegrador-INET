<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use MercadoPago\SDK;
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
  public function agregarAlCarrito(Request $request, $id){

    if($request->ajax()){
        $curso=CursoModel::find($id);
        if($request->session()->has('carrito') == false){
            session(['carrito'=>[]]);
            $request->session()->push('carrito',$curso);
        }
        else{
            $request->session()->push('carrito',$curso);
        }
        return response()->json([
            "curso"=>$curso,
            "mensaje"=>"Agregado al carrito correctamente"
        ]);
    }
    // dd($id);
    /*$curso = CursoModel::find($id);
    if($request->session()->has('carrito') == false){
      session(['carrito'=>[]]);
      $request->session()->push('carrito',$curso);
      return redirect('/curso/todos');
    } else {
      $request->session()->push('carrito',$curso);
      return redirect('/curso/todos');
    }*/
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
        $transaccion->estado=1;   //0=en proceso , 1=listo
        $transaccion->user_id=Auth::user()->id;
        $transaccion->curso_id=$p->id;
        $transaccion->save();
    }

    $vac=compact('carrito');
    $this->limpiarCarrito($request);

    return view('pages.exito',$vac);




    /*\MercadoPago\SDK::setClientId("1379163887781279");
    \MercadoPago\SDK::setClientSecret("LpXQvwCSeNCZXL5OYvcO96bEdXKI6LHX");

    $preference = new \MercadoPago\Preference();
    $carrito=$request->session()->get('carrito');
    $items=[];
    foreach($carrito as $p){
        $item= new \MercadoPago\Item();
        $item->id=$p->id;
        $item->title=$p->titulo;
        $item->quantity=1;
        $item->unit_price=$p->precio;
        $item->currency_id="ARS";
        array_push($items,$item);
    }


    $preference->items = $items;

    $preference->save(); # Save the preference and send the HTTP Request to create

    # Return the HTML code for button

    return redirect($preference->sandbox_init_point);
    */
  }
}
?>
