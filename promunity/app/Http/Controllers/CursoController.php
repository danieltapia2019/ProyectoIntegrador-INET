<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;

class CursoController extends Controller
{
    /**
     * Lista todos los cursos de la BD,paginado=10
     */
    public function list(){
        $cursos = CursoModel::paginate(2);
        return view('pages.cursos',compact('cursos'));
    }

    /**
     * Busca los resultados por lenjuage,descripcion y titulo
     */
    public function searchCurso(Request $form){
        $cursos = CursoModel::where('titulo','LIKE','%'.$form['search'].'%')->orWhere('lenguaje','LIKE','%'.$form['search'].'%')->paginate(3);
        return view('pages.cursos',compact('cursos'));
    }
    /**
    *Crea un curso desde el perfil
    */
    public function crearCurso(Request $req){
        $curso = new CursoModel();
        $curso->titulo = $req["titulo"];
        $curso->descripcion = $req["descripcion"];
        $curso->lenguaje = $req["lenguaje"];
        $curso->precio = $req["precio"];
        $curso->autor = $req["autor"];
        $curso->categorias_id = $req["categoria"];
        $path = $req->file('foto_curso')->store('public/img/cursos');
        $nombreArchivo = basename($path);
        $curso->foto_curso = $nombreArchivo;
        $curso->save();
        return redirect ("/perfil");
    }

    /**
     * Agrupa los resultados por categorias
     */
    public function byCategories(/*Request $form*/){
        // $cursos = CursoModel::paginate(5);
        // $aux = cursoModel::find("7");

        // $curso = CursoModel::find("7")->categoria()->find("1");
        return view('pages.cursos',compact('curso'));
    }
}
