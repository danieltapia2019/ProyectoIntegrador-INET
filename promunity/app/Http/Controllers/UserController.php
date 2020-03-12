<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
class UserController extends Controller
{
    //
    public function actualizarDatos(Request $form){
      $usuario = User::find($form['id']);
      if(isset($form['foto'])){
        Storage::delete('avatar/'.$usuario->foto);

        //unlink('/public/storage/img/avatar/'.$usuario->foto);
        //unlink(asset('/storage/img/avatar/'.$usuario->foto));
        //asset('/storage/img/avatar/'.auth()->user()->foto)')*/
        dd($form->file('foto'));

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
