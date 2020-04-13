<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\CursoModel;


class CursoController extends Controller
{
    /**
     * Lista todos los cursos de la BD,paginado=10
     */
    // public function list(){
    //     $cursos = CursoModel::paginate(10);
    //     return view('pages.cursos',compact('cursos'));
    // }
    /**
     * Lista los cursos de un usuario
     */
    public function misCursos(){
        $cursos = CursoModel::all();
        return view('pages.perfil',compact('cursos'));
    }
    

    /**
    *Crea un curso desde el perfil
    */
    public function crearCurso(Request $req){
        $curso = new CursoModel();
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
        $curso->estado = 1;
        $curso->save();
        return redirect ("/perfil");
    }

    /**
     * Está función corresponde a la vista detCurso
     * 
     * Le muestra al usuario el curso con los datos completos
     */
    public function detalle($cursoId){
        $cursoSelect = CursoModel::find($cursoId);//Curso seleccionado
        // dd($cursoSelect);
        $q = $cursoSelect->lenguaje;

        Self::viewIncrement($cursoId);

        $cursosRecom = CursoModel::where([
            ['id','!=',$cursoId],
            ['titulo','LIKE','%'.$q.'%']
            ])->orWhere([
                ['id','!=',$cursoId],
                ['lenguaje','LIKE','%'.$q.'%']
            ])->limit(5)->get();//Cursos recomendados

        return view('pages.detCurso',compact('cursoSelect','cursosRecom'));
    }

    private function viewIncrement($id){
        $curso = CursoModel::find($id);
        $curso->increment('views');
    }
}
