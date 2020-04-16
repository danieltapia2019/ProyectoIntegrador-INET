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
      $email = User::where('email',$form['email'])->exists();
      $username = User::where('username',$form['username'])->exists();
      if($email || $username){
        return redirect('/perfil')->with('message','ERROR');
      }else{
      if(isset($form['foto'])){
      Storage::delete('avatar/'.$usuario->foto);
          //unlink('/public/storage/img/avatar/'.$usuario->foto);
          //unlink(asset('/storage/img/avatar/'.$usuario->foto));
          //asset('/storage/img/avatar/'.auth()->user()->foto)')*/
          $path = $form->file('foto')->store('public/img/avatar');
          $archivo = basename($path);
          $usuario->foto = $archivo;
        }
      $usuario->email = $form['email'];
      $usuario->username = $form['username'];
      $usuario->password = password_hash($form['password'],PASSWORD_DEFAULT);
      $usuario->acceso = $form['acceso'];
      $usuario->estado = $form['estado'];
      $usuario->update();
      return redirect('/perfil');
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
