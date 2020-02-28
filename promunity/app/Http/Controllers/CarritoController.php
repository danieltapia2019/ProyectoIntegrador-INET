<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;

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
    // dd($id);
    $curso = CursoModel::find($id);
    if($request->session()->has('carrito') == false){
      session(['carrito'=>[]]);
      $request->session()->push('carrito',$curso);
      return redirect('/curso/todos');
    } else {
      $request->session()->push('carrito',$curso);
      return redirect('/curso/todos');
    }
  }

  /**
   * 
   */
  public function limpiarCarrito(Request $request){
    $request->session()->flush();
    $cursos=[];
    return view('pages.carrito',compact('cursos'));
  }
}
?>
