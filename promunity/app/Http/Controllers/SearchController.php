<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\TipoModel;
use App\UsoModel;
use App\LenguajeModel;


/**
 * Este controlador pertenece a la vista 'pages/busq.blade.php'
 */
class searchController extends Controller
{
    
    /**
     * Busca los resultados por el atr título de los cursos.
     * En caso de de contener parametros de 'filtro' se llamará a la funcion axuliar
     * 
     * 
     */
    public function searchCurso(Request $form){
        // dd($form);
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $lenguajes = LenguajeModel::all();

        
        //El primer if contiene los cursos solicitados por 'Home' 
        if( isset( $form['q'] ) ){
            $cursos = CursoModel::where('titulo','like','%'.$form['q'].'%')->orWhere('desc','like','%'.$form['q'].'%')->paginate(5);
        }else{
            $cursos = CursoModel::paginate(5);
        }

        $query = $form['q'];

        return view('pages.search.busq',compact('cursos','query'));
    }

    /**
     * Muestra en la pág. todos los resultados en caso de acceder por navbar
     */
    public function indexSearch(){
        $cursos = CursoModel::paginate(5);
        return view('pages.search.busq',compact('cursos'));
    }


    public function filtering(Request $form){
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $lenguajes = LenguajeModel::all();

        if( isset( $form['q'] ) && $form->has( ['state','setTime'] ) ){
            //Uso de los filtros para la busqueda
            $ac = array( $form['tip'], $form['uso'], $form['lng'] ); //arrays 'comprimidos'

            switch ( $form['setTime'] ) {
                case 'd':
                    $cursos = Self::getCursoByDefault( array($form['q'], $form['state']), $ac );
                    break;
                case 'n':
                    $cursos = Self::getCursoByNew( array($form['q'], $form['state']), $ac );
                    break;
                case 'o':
                    $cursos = Self::getCursoByOld( array($form['q'], $form['state']), $ac );
                    break;     
                default:
                    $cursos = CursoModel::all();
                    break;
            }
        }else{
            $cursos = CursoModel::all();
        }

        $query = $form['q'];


        return view('pages.search.filterSearch',compact('cursos','tipos','usos','lenguajes','query'));

    }

    /**
     * Funcion Auxiliar que permite 'filtrar' los resultados *por defecto*
     * 
     * @return collection
     */
    private function getCursoByDefault($qState, $filters){
        $q = $qState['0'];
        $state = $qState['1'];

        $tipo = $filters['0'];
        $uso = $filters['1'];
        $lng = $filters['2'];

        switch ($state) {
            case 0:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->get();
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->get();
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->get();
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->get();
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->get();
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->get();
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->get();
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->get();
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->get();
                break;
        }
    }

    /**
     * Funcion Auxiliar que permite 'filtrar' los resultados *mas nuevos*
     * 
     * @return collection
     */
    private function getCursoByNew($qState, $filters){
        $q = $qState['0'];
        $state = $qState['1'];

        $tipo = $filters['0'];
        $uso = $filters['1'];
        $lng = $filters['2'];

        switch ($state) {
            case 0:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->latest()->get();
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->latest()->get();
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->latest()->get();
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->latest()->get();
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->latest()->get();
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->latest()->get();
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->latest()->get();
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->latest()->get();
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->latest()->get();
                break;
        }
    }

    /**
     * Funcion Auxiliar que permite 'filtrar' los resultados *mas viejos*
     * 
     * @return collection
     */
    private function getCursoByOld($qState, $filters){
        $q = $qState['0'];
        $state = $qState['1'];

        $tipo = $filters['0'];
        $uso = $filters['1'];
        $lng = $filters['2'];

        switch ($state) {
            case 0:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->oldest()->get();
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->oldest()->get();
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->oldest()->get();
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->oldest()->get();
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->oldest()->get();
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->oldest()->get();
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->oldest()->get();
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->oldest()->get();
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->oldest()->get();
                break;
        }
    }
}
?>