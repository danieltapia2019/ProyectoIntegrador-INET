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
    return view('home');
  }


  public function getConsultas(Request $request){
    $consultas;
    $orden;
    if($request['tipo']){

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
        break;
        case 1:
        $consultas = ConsultaModel::orderBy('nombre',$orden)->paginate(5);
        break;
        case 2:
        $consultas = ConsultaModel::orderBy('email',$orden)->paginate(5);
        break;
        case 3:
        $consultas = ConsultaModel::orderBy('telefono',$orden)->paginate(5);
        break;
        case 4:
        $consultas = ConsultaModel::orderBy('created_at',$orden)->paginate(5);
        break;
        default:
        $consultas = ConsultaModel::orderBy('id',$orden)->paginate(5);
        break;
      }
    return view('pages.abm.consultas',compact('consultas'));
    }else{
    $consultas = ConsultaModel::paginate(5);
    return view('pages.abm.consultas',compact('consultas'));
    }
  }


  public function deleteConsulta(Request $form){
    ConsultaModel::find($form['id'])->delete();
    return redirect('pages.abm.consultas');
  }
}
