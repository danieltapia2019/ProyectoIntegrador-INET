<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\CursoModel;
use App\CategoriaModel;
use App\User;
use App\TipoModel;
use App\UsoModel;
use App\Transaccion;

class adminController extends Controller{
  public function abm(){
    // $views = CursoModel::sum('views');
    $totales = array(CursoModel::count(),User::count(),CursoModel::sum('views'));
    // $userTotal = ;
    return view('pages.abm',compact('totales'));
  }

  /*CURSO*/

  public function borrarCurso($id){
    $curso = CursoModel::find($id);
    $curso->estado = 0;
    $curso->update();
    $response = array(
      'status' => 'success',
      'msg' => 'Element delete successfully',
    );
    return response()->json($response);
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
  /*USUARIO*/
  public function crearUsuario(Request $request){
    if($request){
      $nombre = $request['username'];
      $email = $request['email'];
      $password = $request['password'];
      $acceso = $request['acceso'];
      $emailRepetido = User::where('email',$email)->exists();
      $usernameRepetido = User::where('username',$nombre)->exists();
      if($emailRepetido || $usernameRepetido){
        $response = array(
          'status' => 'failure',
          'msg' => 'Element already exists',
        );
        return response()->json($response);
      }else{
        $usuario = new User();
        $usuario->username = $nombre;
        $usuario->email = $email;
        $usuario->password = password_hash($password,PASSWORD_DEFAULT);
        $usuario->estado = 1;
        $usuario->acceso = $acceso;
        $usuario->foto = NULL;
        $usuario->remember_token = NULL;
        $usuario->opinion = NULL;
        $usuario->save();
        return response()->json($usuario);  // <<<<<<<<< see this line
      }
    }else{
      return 'No se pudo crear';
    }
  }
  public function borrarUsuario($id){
    $usuario = User::find($id);
    $usuario->estado = 0;
    $usuario->update();
    $response = array(
      'status' => 'success',
      'msg' => 'Element delete successfully',
    );
    return response()->json($response);
  }
  public function actualizarUsuario($id,Request $request){
    if($request){
      $usuario = User::findOrFail($id);
      $nombre = $request['username'];
      $email = $request['email'];
      $acceso = $request['acceso'];
      $emailRepetido = User::where('email',$email)->where('id',"!=",$id)->exists();
      $usernameRepetido = User::where('username',$nombre)->where('id',"!=",$id)->exists();
      if($emailRepetido || $usernameRepetido){
        $response = array(
          'status' => 'failure',
          'msg' => 'Element already exists',
        );
        return response()->json($response);
      }else{
        $usuario->username = $nombre;
        $usuario->email = $email;
        $usuario->acceso = $acceso;
        $usuario->update();
        return response()->json($usuario);
      }
    }else{
        $response = array(
          'status' => 'failure',
          'msg' => 'Error',
        );
      return response()->json($response);
    }
  }

  /*USO*/

  public function crearUso(Request $request){
    if($request){
      $uso = new UsoModel();
      $uso->usoNombre = $request['snombre'];
      $uso->estado = 1;
      $uso->save();
      return response()->json($uso);
    }else{
      return 'NO';
    }
  }
  public function actualizarUso($id,Request $request){
    $uso = UsoModel::findOrFail($id);
    $uso->usoNombre = $request['snombre'];
    $uso->update();
    return response()->json($uso);
  }
  public function borrarUso($id){
    $uso = UsoModel::find($id);
    $uso->estado = 0;
    $uso->update();
    $response = array(
      'status' => 'success',
      'msg' => 'Element delete successfully',
    );
    return response()->json($response);
  }

  /*TIPO*/

  public function crearTipo(Request $request){
    if($request){
      $tipo = new TipoModel();
      $tipo->tipoNombre = $request['tnombre'];
      $tipo->estado = 1;
      $tipo->save();
      return response()->json($tipo);
    }else{
      return 'NO se pudo crear';
    }
  }
  function borrarTipo($id){
    $tipo = TipoModel::find($id);
    $tipo->estado = 0;
    $tipo->update();
    $response = array(
      'status' => 'success',
      'msg' => 'Element delete successfully',
    );
    return response()->json($response);
  }
  public function actualizarTipo($id,Request $request){
    $tipo = TipoModel::findOrFail($id);
    $tipo->tipoNombre = $request['tipoNombre'];
    $tipo->update();
    return response()->json($tipo);
  }

  public function getUsuarios(Request $request){
    if($request['tipo']){
      $usuarios = User::orderBy($request['atributo'],$request['tipo'])->where('estado','=','1')->paginate(5);
      return view('pages.abm.usuarios',compact('usuarios'));
    }else {
      $usuarios = User::orderBy('acceso','desc')->where('estado','=','1')->paginate(5);
      return view("pages.abm.usuarios",compact('usuarios'));
    }
  }

  public function getCursos(Request $request){
    if($request['tipo']){
      $cursos = CursoModel::orderBy($request['atributo'],$request['tipo'])->where('estado','=','1')->paginate(10);
      return view('pages.abm.cursos',compact('cursos'));
    }else{
      $cursos = CursoModel::where('estado','=','1')->paginate(10);
      return view("pages.abm.cursos",compact('cursos'));
    }
  }

  public function getTipos(Request $request){
    if($request['tipo']){
    $tipos = TipoModel::orderBy($request['atributo'],$request['tipo'])->where('estado','=','1')->paginate(10);
    return view('pages.abm.tipos',compact('tipos'));
    }else{
    $tipos = TipoModel::where('estado','=','1')->paginate(10);
    return view("pages.abm.tipos",compact('tipos'));
  }

  }
  public function getUsos(Request $request){
    if($request['tipo']){
    $usos = UsoModel::orderBy($request['atributo'],$request['tipo'])->where('estado','=','1')->paginate(10);
    return view('pages.abm.tipos',compact('usos'));
    }else{
    $usos = UsoModel::where('estado','=','1')->paginate(10);
    return view("pages.abm.usos",compact('usos'));
  }
  }

  public function getTransacciones(){
    $transacciones=Transaccion::all();
    return view("pages.abm.transacciones",compact('transacciones'));
  }
  public function activarCurso(Request $request,$id){
    if($request->ajax()){
        $transaccion=Transaccion::find($id);
        $curso=$transaccion->curso;
        $alumno=$transaccion->usuario;
        $curso->alumno()->attach($alumno->id);
        $curso->save();
        $alumno->save();
        $transaccion->estado=1;
        $transaccion->save();
        return response()->json([
            "mensaje"=>"Curso habilitado correctamente"
        ]);
    }
}

}
