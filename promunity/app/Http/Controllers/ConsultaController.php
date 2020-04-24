<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConsultaModel;


class ConsultaController extends Controller
{
  /**
   * Resive los datos de las consultas
   */

  public function insertarConsulta(Request $form){
    // dd($form);

    $validatedData = $form->validate([
      'nombre' => 'required',
      'email' => 'required',
      'tel' => 'required',
      'consulta' => 'required | min:3 | max:1000'
    ]);

    $consulta = new consultaModel();

    $consulta->nombre = $form['nombre'];
    $consulta->email = $form['email'];
    $consulta->telefono = $form['tel'];
    $consulta->consulta = $form['consulta'];

    $consulta->save();
    return redirect('/home');
  }


  public function getConsultas(Request $request){
    $consultas;
    $orden;
    $link = "";
    $numOrden;
    if($request['tipo']){
      $numOrden = $request['tipo'];
      switch ($request['tipo']) {
        case 0:
        // code...
        $orden = "desc";
        break;
        case 1:
        $orden = "desc";
        break;
        default:
        // code...
        $orden = "asc";
        break;
      }
      switch ($request['atributo']) {
        case 0:
        $consultas = ConsultaModel::orderBy('id',$orden)->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
        case 1:
        $consultas = ConsultaModel::orderBy('nombre',$orden)->paginate(5);
        $link = "&atributo=1&tipo=$numOrden";
        break;
        case 2:
        $consultas = ConsultaModel::orderBy('email',$orden)->paginate(5);
        $link = "&atributo=2&tipo=$numOrden";
        break;
        case 3:
        $consultas = ConsultaModel::orderBy('telefono',$orden)->paginate(5);
        $link = "&atributo=3&tipo=$numOrden";
        break;
        case 4:
        $consultas = ConsultaModel::orderBy('created_at',$orden)->paginate(5);
        $link = "&atributo=4&tipo=$numOrden";
        break;
        default:
        $consultas = ConsultaModel::orderBy('id',$orden)->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
      }
    return view('pages.abm.consultas',compact('consultas','link'));
    }else{
    $consultas = ConsultaModel::paginate(5);
    return view('pages.abm.consultas',compact('consultas','link'));
    }
  }


  public function deleteConsulta(Request $form){
    ConsultaModel::find($form['id'])->delete();
    return redirect('pages.abm.consultas');
  }
}
