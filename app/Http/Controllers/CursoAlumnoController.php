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
    public function indexCurso(Request $form){

        $curso = CursoModel::find($form['cid']);
        $user = User::find($form['uid']);


        if( $this->val($user->id,$curso->id) ){
          return view('pages.curso',compact('curso'));
        } else {
          return redirect('error');
        }
    }


    /**
     * Valida que el usuario este anotado en el curso
     */
    private function val($uid,$cid){
        $aux = AlumnoCurso::where([
            [ 'curso_id','=',$cid ],
            [ 'user_id','=',$uid ]
        ])->get();
        try {
            return (count( $aux ) != 0)? true : false;
        } catch (\Throwable $th) {
            return redirect('error');
        }
    }
}
