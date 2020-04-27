<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Cookie;

use App\User;
use App\CursoModel;
use App\TipoModel;
use App\UsoModel;
use App\LenguajeModel;


class UserController extends Controller
{
    //Abrir Perfil
    public function miPerfil(){
        $cursos;
        $usuario = User::find(auth()->user()->id);
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $lenguajes = LenguajeModel::all();
        $vac;
        if($usuario->acceso != 2){
        $cursos = $usuario->cursos;
        $vac = compact('tipos','usos','cursos','lenguajes','usuario');
        return view('pages.perfil',$vac);
        }else{
        $cursos = $usuario->alumno_curso;
        $vac = compact('usuario','cursos');
        return view('pages.perfil',$vac);
        }
    }
    //Actualizacion de datos
    public function actualizarDatos(Request $form){
      $usuario = User::find($form['id']);
      $id = $usuario->id;
      $email = $form['email'];
      $nombre = $form['username'];
      $password = $form['password'];
      $emailRepetido = User::where('email',$email)->where('id',"!=",$id)->exists();
      $usernameRepetido = User::where('username',$nombre)->where('id',"!=",$id)->exists();
      if($emailRepetido || $usernameRepetido){
          return redirect('/perfil')->with('message','ERROR');
      }else{
      if(isset($form['foto'])){
          $path = $form->file('foto')->store('public/img/avatar');
          $archivo = basename($path);
          $usuario->foto = $archivo;
        }
      $usuario->email = $email;
      $usuario->username = $nombre;
      if($password != null){
      $usuario->password = password_hash($password,PASSWORD_DEFAULT);
      }
      $usuario->update();
      return redirect('/perfil')->with('message','success');
      }
    }

    //Dejar opinion
    public function darOpinion(Request $request){
      $usuario = User::find(auth()->user()->id);
      $usuario->opinion = $request['opinion'];
      $usuario->update();
      $response = array(
        'status' => 'success',
        'msg' => 'opinion created successfully',
      );
      return response()->json($response);
    }
    /**
     * Crea una cookie en la cual se almacena el tema elegido por el @Usuario
     */
    public function theme(Request $form){
      // dd($form);
      // return redirect('/setting')->withCookie(cookie('theme', $form['userPreference'], 60));
      Cookie::queue('theme', $form['userPreference'], 60*24*30);
      // if( Cookie::get('theme')==='dark'){
        return redirect('/setting');
      // }
    }

}
