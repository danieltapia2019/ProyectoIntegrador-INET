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
use App\AlumnoCurso;
use App\LenguajeModel;


class adminController extends Controller{
  public function indexAbm(){
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
    $lenguajes = LenguajeModel::all();
    //$profesores = User::orderBy('username')->where('acceso','=','1');
    $profesores = User::where('acceso','=','1')->orderBy('username','asc')->get();
    $vac = compact('curso','tipos','usos','lenguajes','profesores');
    return view ("pages.editarCurso",$vac);
  }
  public function actualizarCurso(Request $req){
    $curso = CursoModel::find($req['id']);
    $curso->titulo = $req["titulo"];
    $curso->desc = $req["descripcion"];
    $curso->lenguaje_id = $req["lenguaje"];
    $curso->precio = $req["precio"];
    $curso->autor = $req["autor"];
    $curso->tipo_id = $req['tipo'];
    $curso->uso_id = $req['uso'];
    $path = $req->file('foto_curso')->store('public/img/cursos');
    $nombreArchivo = basename($path);
    $curso->foto_curso = $nombreArchivo;
    $curso->update();
    return redirect ("/abm/cursos")->with('message','SUCCESS');
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
        if($request['pass']){
        $usuario->password = password_hash($request['pass'],PASSWORD_DEFAULT);
        }
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
    $numOrden;
    $usuarios;
    $link = "";
    if($request['tipo'] !=null){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
          // ID
          $usuarios = User::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=0&tipo=$numOrden";
          break;
        case 1:
          // Nombre de usuario
          $usuarios = User::orderBy('username',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=1&tipo=$numOrden";
          break;
        case 2:
          // Email
          $usuarios = User::orderBy('email',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=2&tipo=$numOrden";
          break;
        case 3:
          // Acceso
          $usuarios = User::orderBy('acceso',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=3&tipo=$numOrden";
          break;
        case 4:
          // Creacion
          $usuarios = User::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=4&tipo=$numOrden";
          break;
        default:
          // ID
          $usuarios = User::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
          $link = "&atributo=0&tipo=$numOrden";
          break;
      }

      return view('pages.abm.usuarios',compact('usuarios','link'));
    }else {
      $usuarios = User::orderBy('acceso','desc')->where('estado','=','1')->paginate(5);
      return view("pages.abm.usuarios",compact('usuarios','link'));
    }
  }

  public function getCursos(Request $request){
    $orden;
    $cursos;
    $link = "";
    $numOrden;
    if($request['tipo'] !=null){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        // ID
        $cursos = CursoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
        case 1:
        // code...
        $cursos = CursoModel::orderBy('titulo',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=1&tipo=$numOrden";
        break;

        case 2:

        // code...
        $cursos = CursoModel::where('cursos.estado','=','1')->join('lenguajes','lenguajes.id','=','cursos.lenguaje_id')
        ->select('lenguajes.nombreLenguaje as nombreLenguaje','cursos.*')
        ->orderBy('nombreLenguaje',$orden)
        ->paginate(5);
        $link = "&atributo=2&tipo=$numOrden";
        break;

        case 3:
        // code...
        $cursos = CursoModel::orderBy('precio',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=3&tipo=$numOrden";
        break;

        case 4:
        // code...
        $cursos = CursoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=4&tipo=$numOrden";
        break;

        case 5:
        $cursos = CursoModel::where('cursos.estado','=','1')->join('users','users.id','=','cursos.autor')
        ->select('users.username as nombre','cursos.*')
        ->orderBy('nombre',$orden)
        ->paginate(5);
        $link = "&atributo=5&tipo=$numOrden";
        break;

        default:
          // code...
        $cursos = CursoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
          break;
      }
      return view('pages.abm.cursos',compact('cursos','link'));
    }else{
      $cursos = CursoModel::where('estado','=','1')->paginate(5);
      return view("pages.abm.cursos",compact('cursos','link'));
    }
  }

  public function getTipos(Request $request){
    $tipos;
    $orden;
    $link = "";
    $numOrden;
    if($request['tipo'] != null){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        // code...
      $tipos = TipoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=0&tipo=$numOrden";
        break;

        case 1:
        // code...
      $tipos = TipoModel::orderBy('tipoNombre',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=1&tipo=$numOrden";
        break;

        case 2:
        // code...
      $tipos = TipoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=2&tipo=$numOrden";
        break;
        default:
        // code...

      $tipos = TipoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=0&tipo=$numOrden";
        break;
      }
    return view('pages.abm.tipos',compact('tipos','link'));
    }else{
    $tipos = TipoModel::where('estado','=','1')->paginate(5);
    return view("pages.abm.tipos",compact('tipos','link'));
  }
  }
  public function getUsos(Request $request){
    $usos;
    $orden;
    $link = "";
    $numOrden;
    if($request['tipo']){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        // code...
      $usos = UsoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=0&tipo=$numOrden";
        break;

        case 1:
        // code...
      $usos = UsoModel::orderBy('usoNombre',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=1&tipo=$numOrden";
        break;

        case 2:
        // code...
      $usos = UsoModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=2&tipo=$numOrden";
        break;
        default:
        // code...

      $usos = UsoModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
      $link = "&atributo=0&tipo=$numOrden";
        break;
      }
    return view('pages.abm.usos',compact('usos','link'));
    }else{
    $usos = UsoModel::where('estado','=','1')->paginate(5);
    return view("pages.abm.usos",compact('usos','link'));
  }
  }

  public function getAlumnosCursos(Request $request){
    $orden;
    $alumnos_cursos;
    $link = "";
    $numOrden;
    if($request['tipo'] != null){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        $alumnos_cursos = AlumnoCurso::orderBy('curso_id',$orden)->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
        case 1:
        $alumnos_cursos = AlumnoCurso::join('cursos','cursos.id','=','usuario_curso.curso_id')
        ->select('cursos.titulo as titulo','usuario_curso.*')
        ->orderBy('titulo',$orden)
        ->paginate(5);
        $link = "&atributo=1&tipo=$numOrden";
        break;
        case 2:
        //Nombre usuario
        $alumnos_cursos = AlumnoCurso::join('users','users.id','=','usuario_curso.user_id')
        ->select('users.username as username','usuario_curso.*')
        ->orderBy('username',$orden)
        ->paginate(5);
        $link = "&atributo=2&tipo=$numOrden";
        break;
        case 3:
        //ID usuario
        $alumnos_cursos = AlumnoCurso::orderBy('user_id',$orden)->paginate(5);
        $link = "&atributo=3&tipo=$numOrden";
        break;
        default:
        $alumnos_cursos = AlumnoCurso::paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
      }
    return view("pages.abm.cursos_alumnos",compact('alumnos_cursos','link'));
    }else{
    $alumnos_cursos = AlumnoCurso::paginate(5);
    return view("pages.abm.cursos_alumnos",compact('alumnos_cursos','link'));
    }
  }

  public function getTransacciones(Request $request){
    $orden;
    $link = "";
    $numOrden;
    $transacciones;
    if($request['tipo'] != null){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        $transacciones = Transaccion::orderBy('id',$orden)->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
        case 1:
        //Nombre Usuario
        $transacciones = Transaccion::join('users','users.id','=','transaccion.user_id')
        ->select('users.username as username','transaccion.*')
        ->orderBy('username',$orden)
        ->paginate(5);
        $link = "&atributo=1&tipo=$numOrden";
        break;
        case 2:
        //titulo Curso
        $transacciones = Transaccion::join('cursos','cursos.id','=','transaccion.curso_id')
        ->select('cursos.titulo as titulo','transaccion.*')
        ->orderBy('titulo',$orden)
        ->paginate(5);
        $link = "&atributo=2&tipo=$numOrden";
        break;
        case 3:
        //Estado
        $transacciones = Transaccion::orderBy('estado',$orden)->paginate(5);
        $link = "&atributo=3&tipo=$numOrden";
        break;

        case 3:
        //Referencia
        $transacciones = Transaccion::orderBy('referencia',$orden)->paginate(5);
        $link = "&atributo=3&tipo=$numOrden";
        break;
        default:
        $transacciones = Transaccion::orderBy('id',$orden)->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
      }
    return view("pages.abm.cursos_alumnos",compact('alumnos_cursos','link'));
    }else{
    $transacciones=Transaccion::paginate(5);
    return view("pages.abm.transacciones",compact('transacciones','link'));
    }
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
  public function getLenguajes(Request $request){
    $orden;
    $lenguajes;
    $link = "";
    $numOrden;
    if($request['tipo']){
      $orden = $this->orden($request['tipo']);
      $numOrden = $request['tipo'];
      switch ($request['atributo']) {
        case 0:
        $lenguajes = LenguajeModel::orderBy('id',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
        case 1:
        $lenguajes = LenguajeModel::orderBy('nombreLenguaje',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=1&tipo=$numOrden";
        break;
        case 2:
        $lenguajes = LenguajeModel::orderBy('created_at',$orden)->where('estado','=','1')->paginate(5);
        $link = "&atributo=2&tipo=$numOrden";
        break;
        default:
        $lenguajes = LenguajeModel::where('estado','=','1')->paginate(5);
        $link = "&atributo=0&tipo=$numOrden";
        break;
      }
      return view('pages.abm.lenguajes',compact('lenguajes','link'));
    }else{
    $lenguajes = LenguajeModel::where('estado','=','1')->paginate(5);
    return view('pages.abm.lenguajes',compact('lenguajes','link'));
    }
  }


  //FUNCION PARA ORDENAR LA BUSQUEDA EN EL ABM
  public function orden($orden){
      switch ($orden) {
        case 0:
        $orden = "asc";
        break;
        case 1:
        $orden = "desc";
        break;
        default:
        $orden = "asc";
        break;
      }
    return $orden;
  }
}
