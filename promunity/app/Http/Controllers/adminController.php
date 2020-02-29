<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\CategoriaModel;
use App\User;
use App\TipoModel;
use App\UsoModel;

class adminController extends Controller
{
    public function listAll(){
        $alumnos = User::where('acceso','=','2')->get();
        $profesores = User::where('acceso','=','1')->get();
        $admins = User::where('acceso','=','0')->get();
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $cursos = CursoModel::all();
        $vac = compact('alumnos','profesores','admins','cursos','tipos','usos');
        return view('pages.abm',$vac);
    }
    public function editarCurso(){

    }
    public function actualizarCurso(){
      
    }
    public function crearUsuario(Request $form){
        $usuario = new User();
        $usuario->username = $form['username'];
        $usuario->email = $form['email'];
        $usuario->password = password_hash($form['password'],PASSWORD_DEFAULT);
        $usuario->foto = NULL;
        $usuario->acceso = $form['acceso'];
        $usuario->remember_token = NULL;
        $usuario->save();
        return redirect ("/admin/abm");
    }
    public function borrarUsuario(Request $form){
       $usuario = User::find($form['id']);
       $usuario->delete();
       return redirect ("/admin/abm");
    }
    public function editarUsuario(Request $form){
      $usuario = User::find($form['id']);
      return view ("pages.editarUsuario",compact("usuario"));
    }
    public function actualizarUsuario(Request $form){
      $usuario = User::find($form['id']);
      $usuario->username = $form['username'];
      $usuario->email = $form['email'];
      $usuario->password = password_hash($form['password'],PASSWORD_DEFAULT);
      $usuario->foto = NULL;
      $usuario->acceso = $form['acceso'];
      $usuario->remember_token = NULL;
      $usuario->update();
      return redirect ("/admin/abm");
    }

    public function crearUso(Request $form){
      $uso = new UsoModel();
      $uso->snombre = $form['snombre'];
      $uso->save();
      return redirect ("/admin/abm");
    }
    public function borrarUso(Request $form){
      $uso = UsoModel::find($form['id']);
      $uso->delete();
      return redirect ("/admin/abm");
    }

    public function crearTipo(Request $form){
      $tipo = new TipoModel();
      $tipo->tnombre = $form['tnombre'];
      $tipo->save();
      return redirect ("/admin/abm");
    }
    function borrarTipo(Request $form){
      $tipo = TipoModel::find($form['id']);
      $tipo->delete();
      return redirect ("/admin/abm");
    }


}
