<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use App\CursoModel;
use App\AlumnoCurso;


class CursoAlumnoController extends Controller
{
    /**
     * Recibe los parametros a traves de un form oculto
     */
    public function verCursoAlumno($cursoTitulo, Request $urlUID){
        
        $curso = CursoModel::where('titulo','=',$cursoTitulo)->first();

        if( Self::validarAcceso($urlUID['uid'],$curso) ){
          return view('pages.curso',compact('curso'));
        } else {
          return redirect('error');
        }
    }

    private function validarAcceso($id, $curso){
        $alumno = User::find($id);

        if( ( $alumno != null ) && ( $curso != null ) ){
            $alumnoCurso = AlumnoCurso::where([
                ['user_id','=',$alumno->id],
                ['curso_id','=',$curso->id]
            ])->get();
            return ( $alumnoCurso->count() != 0 )? true : false;
        } else {
            return false;
        }
    }
}
