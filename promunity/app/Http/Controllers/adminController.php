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
        $tipos = TipoModel::where('estado','=','1');
        $usos = UsoModel::where('estado','=','1');
        $cursos = CursoModel::where('estado','=','1');
        $vac = compact('alumnos','profesores','admins','cursos','tipos','usos');
        return view('pages.abm',$vac);
    }
    public function borrarCurso(Request $form){
        $curso = CursoModel::find($form['id']);
          foreach ($curso->alumno as $key => $alumnos)
          {
            $alumno = User::find($alumnos->id);
            $alumno->delete();
          }
        $curso->delete();
        return redirect ('/admin/abm');
    }
    public function editarCurso(Request $form){
        $curso = CursoModel::find($form['id']);
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $vac = compact('curso','tipos','usos');
        return view ("pages.editarCurso",$vac);
    }
    public function actualizarCurso(Request $form){
       $curso = CursoModel::find($form['id']);
       $curso->titulo = $req["titulo"];
       $curso->desc = $req["descripcion"];
       $curso->lenguaje = $req["lenguaje"];
       $curso->precio = $req["precio"];
       $curso->autor = $req["autor"];
       $curso->tipo_id = $req['tipo'];
       $curso->uso_id = $req['uso'];
       $path = $req->file('foto_curso')->store('public/img/cursos');
       $nombreArchivo = basename($path);
       $curso->foto_curso = $nombreArchivo;
       $curso->update();
       return redirect ("/admin/abm");
    }

    public function crearUsuario(Request $form){
        $usuario = new User();
        $usuario->username = $form['username'];
        $usuario->email = $form['email'];
        $usuario->password = password_hash($form['password'],PASSWORD_DEFAULT);
        $usuario->foto = NULL;
        $usuario->acceso = $form['acceso'];
        $usuario->remember_token = NULL;
        $usuario->estado = 1;
        $usuario->save();
        return redirect ("/admin/abm");
    }
    public function borrarUsuario(Request $form){
        $usuario = User::find($form['id']);
        $usuario->estado = 0;
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
       $uso->usoNombre = $form['nombre'];
       $uso->estado = 1;
       $uso->save();
       return redirect ("/admin/abm");
    }
    public function borrarUso(Request $form){
       $uso = UsoModel::find($form['id']);
       $uso->estado = 0;
       return redirect ("/admin/abm");
    }

    public function crearTipo(Request $form){
       $tipo = new TipoModel();
       $tipo->tipoNombre = $form['tnombre'];
       $tipo->estado = 1;
       $tipo->save();
       return redirect ("/admin/abm");
    }
    function borrarTipo(Request $form){
       $tipo = TipoModel::find($form['id']);
       $uso->estado = 0;
       return redirect ("/admin/abm");
    }


}
