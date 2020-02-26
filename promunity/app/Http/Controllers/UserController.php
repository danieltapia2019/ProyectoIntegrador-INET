<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //
    public function listadoAlumnos(){

      //$alumnos = UserModel::where('acceso','=','2')->get();
      $alumnos = User::all();
      return view('pages.abm',compact('alumnos'));
    }
    public function listadoProfesores(){
      $profesores = User::where('acceso','=','1')->get();
      return view('pages.abm',compact('profesores'));
    }
    public function listadoAdministradores(){
      $administradores = User::where('acceso','=','0')->get();
      return view('pages.abm',compact('administradores'));
    }
}
