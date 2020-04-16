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


  public function getConsultas(){
    $consultas = ConsultaModel::get();
    return view('pages.abm.consultas',compact('consultas'));
  }


  public function deleteConsulta(Request $form){
    ConsultaModel::find($form['id'])->delete();
    return redirect('pages.abm.consultas');
  }
}
