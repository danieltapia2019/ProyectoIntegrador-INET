<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\CursoModel;
use App\CategoriaModel;
use App\User;
use App\TipoModel;
use App\UsoModel;
use App\AlumnoCurso;
use App\LenguajeModel;

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

  /*LENGUAJES*/
  public function crerLenguaje(Request $request){
    if($request){
      $lenguaje = new LenguajeModel();
      $lenguaje->nombreLenguaje = $request['lnombre'];
      $lenguaje->estado = 1;
      $lenguaje->save();
      return response()->json($lenguaje);
    }else{
      $response = array(
        'status' => 'failure',
        'msg' => 'Element has not been created',
      );
      return response()->json($response);
    }
  }
  public function borrarLenguaje($id,Request $request){
      $lenguaje = LenguajeModel::find($id);
      $lenguaje->estado = 0;
      $lenguaje->update();
      $response = array(
        'status' => 'success',
        'msg' => 'Element delete successfully',
      );
      return response()->json($response);
  }
  public function actualizarLenguaje($id,Request $request){
    $lenguaje = LenguajeModel::find($id);
    $lenguaje->nombreLenguaje = $request['lnombre'];
    $lenguaje->update();
    return response()->json($lenguaje);
  }

  public function getUsuarios(Request $request){
    $orden;
    $usuarios;
    if($request['tipo']){
      switch ($request['tipo']) {
        case 0:$orden = "asc";break;
        case 1:$orden = "desc";break;
        default:
          $orden = "asc";
          break;
      }
      switch ($request['atributo']) {
        case 0:
          // ID
          $usuarios = User::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
          break;
        case 1:
          // Nombre de usuario
          $usuarios = User::orderBy('username',$orden)->where('estado','=','1')->paginate(5);
          break;
        case 2:
          // Email
          $usuarios = User::orderBy('email',$orden)->where('estado','=','1')->paginate(5);
          break;
        case 3:
          // Acceso
          $usuarios = User::orderBy('acceso',$orden)->where('estado','=','1')->paginate(5);
          break;
        case 4:
          // Creacion
          $usuarios = User::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
          break;
        default:
          // ID
          $usuarios = User::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
          break;
      }
      return view('pages.abm.usuarios',compact('usuarios'));
    }else {
      $usuarios = User::orderBy('acceso','desc')->where('estado','=','1')->paginate(5);
      return view("pages.abm.usuarios",compact('usuarios'));
    }
  }

  public function getCursos(Request $request){
    $orden;
    $cursos;
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
        // ID
        $cursos = CursoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 1:
        // code...
        $cursos = CursoModel::orderBy('titulo',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 2:
        // code...
        $cursos = CursoModel::orderBy('lenguaje_id',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 3:
        // code...
        $cursos = CursoModel::orderBy('precio',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 4:
        // code...
        $cursos = CursoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
        break;

        default:
          // code...
        $cursos = CursoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
          break;
      }
      return view('pages.abm.cursos',compact('cursos'));
    }else{
      $cursos = CursoModel::where('estado','=','1')->paginate(5);
      return view("pages.abm.cursos",compact('cursos'));
    }
  }

  public function getTipos(Request $request){
    $tipos;
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
        // code...
      $tipos = TipoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 1:
        // code...
      $tipos = TipoModel::orderBy('usoNombre',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 2:
        // code...
      $tipos = TipoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
        break;
        default:
        // code...

      $tipos = TipoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        break;
      }
    return view('pages.abm.tipos',compact('tipos'));
    }else{
    $tipos = TipoModel::where('estado','=','1')->paginate(5);
    return view("pages.abm.tipos",compact('tipos'));
  }
  }
  public function getUsos(Request $request){
    $usos;
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
        // code...
      $usos = UsoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 1:
        // code...
      $usos = UsoModel::orderBy('usoNombre',$orden)->where('estado','=','1')->paginate(5);
        break;

        case 2:
        // code...
      $usos = UsoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
        break;
        default:
        // code...

      $usos = UsoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        break;
      }
    return view('pages.abm.usos',compact('usos'));
    }else{
    $usos = UsoModel::where('estado','=','1')->paginate(5);
    return view("pages.abm.usos",compact('usos'));
  }
  }

  public function getAlumnosCursos(){
    $alumnos_cursos = AlumnoCurso::paginate(5);
    return view("pages.abm.cursos_alumnos",compact('alumnos_cursos'));
  }

  public function getLenguajes(){
    $lenguajes = LenguajeModel::where('estado','=','1')->paginate(5);
    return view('pages.abm.lenguajes',compact('lenguajes'));
  }


}
