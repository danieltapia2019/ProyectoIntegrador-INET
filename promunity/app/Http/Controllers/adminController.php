<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\CursoModel;
use App\CategoriaModel;
use App\User;
use App\TipoModel;
use App\UsoModel;

class adminController extends Controller
{
    public function listAll(){
        $alumnos = User::where('acceso','=','2')->where('estado','=','1')->paginate(10);
        $profesores = User::where('acceso','=','1')->where('estado','=','1')->paginate(10);
        $admins = User::where('acceso','=','0')->where('estado','=','1')->paginate(10);
        $tipos = TipoModel::where('estado','=','1')->paginate(10);
        $usos = UsoModel::where('estado','=','1')->paginate(10);
        $cursos = CursoModel::where('estado','=','1')->paginate(10);
        $vac = compact('alumnos','profesores','admins','cursos','tipos','usos');
        return view('pages.abm',$vac);
    }
    public function borrarCurso(Request $form){
        $curso = CursoModel::find($form['id']);
        $curso->estado = 0;
        $curso->update();
        return redirect ('/admin/abm')->with('message','ERROR');
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
       return redirect ("/admin/abm")->with('message','SUCCESS');;;
    }

    public function crearUsuario(Request $form){
        $usuario = new User();
        $email = User::where('email',$form['email'])->exists();
        $username = User::where('username',$form['username'])->exists();
        if($email || $username){
          return redirect('/admin/abm')->with('message','ERROR');
        }else{
        $usuario->username = $form['username'];
        $usuario->email = $form['email'];
        $usuario->password = password_hash($form['password'],PASSWORD_DEFAULT);
        $usuario->foto = NULL;
        $usuario->acceso = $form['acceso'];
        $usuario->remember_token = NULL;
        $usuario->estado = 1;
        $usuario->save();
        return redirect ("/admin/abm")->with('message','SUCCESS');
        }
    }
    public function borrarUsuario(Request $form){
        $usuario = User::find($form['id']);
        $usuario->estado = 0;
        $usuario->update();
        return redirect ("/admin/abm")->with('message','ELIMINAR');
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
       return redirect ("/admin/abm")->with('message','SUCCESS');;;
    }

    public function crearUso(Request $form){
       $uso = new UsoModel();
       $uso->usoNombre = $form['nombre'];
       $uso->estado = 1;
       $uso->save();
       return redirect ("/admin/abm")->with('message','SUCCESS');
    }
    public function borrarUso(Request $form){
       $uso = UsoModel::find($form['id']);
       $uso->estado = 0;
       $uso->update();
       return redirect ("/admin/abm");
    }

    public function crearTipo(Request $form){
       $tipo = new TipoModel();
       $tipo->tipoNombre = $form['tnombre'];
       $tipo->estado = 1;
       $tipo->save();
       return redirect ("/admin/abm")->with('message','SUCCESS');
    }
    function borrarTipo(Request $form){
       $tipo = TipoModel::find($form['id']);
       $tipo->estado = 0;
       $tipo->update();
       return redirect ("/admin/abm")->with('message','ELIMINAR');
    }


}
