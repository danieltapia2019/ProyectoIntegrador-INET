<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\TipoModel;
use App\UsoModel;


/**
 * Este controlador pertenece a la vista 'pages/busq.blade.php'
 */
class searchController extends Controller
{
    
    /**
     * Busca los resultados por lenjuage y titulo 
     */
    public function searchCurso(Request $form){
        // dd($form);
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        if( isset($form['q']) ){
            switch ($form['valState']) {
                case 0:
                    $cursos = CursoModel::where('titulo','LIKE','%'.$form['q'].'%')->orWhere('lenguaje','LIKE','%'.$form['q'].'%')->paginate(5);
                    break;
                case 1:
                    $cursos = CursoModel::where('titulo','LIKE','%'.$form['q'].'%')->where('tipo_id','=',$form['tip'])->paginate(5);
                    break;
                case 2:
                    $cursos = CursoModel::where('titulo','LIKE','%'.$form['q'].'%')->where('uso_id','=',$form['uso'])->paginate(5);
                    break;
                case 3:
                    $cursos = CursoModel::where('titulo','LIKE','%'.$form['q'].'%')->where('tipo_id','=',$form['tip'])->where('uso_id','=',$form['uso'])->paginate(5);
                    break;
                default:
                    $cursos = CursoModel::where('titulo','LIKE','%'.$form['q'].'%')->orWhere('lenguaje','LIKE','%'.$form['q'].'%')->paginate(5);
                    break;
            }
        } else {
            $cursos = CursoModel::paginate(5);
        }
        return view('pages.busq',compact('tipos','usos','cursos'));
    }

    /**
     * Muestra en la pág. todos los resultados en caso de acceder por navbar
     */
    public function indexSearch(){
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $cursos = CursoModel::paginate(5);
        return view('pages.busq',compact('tipos','usos','cursos'));
    }
}
