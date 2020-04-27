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
        $query = $form['q'];
        //El primer if contiene los cursos solicitados por 'Home' 
        try {
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
                        //q=a & tip=all & uso=all & lng=all & ord=all
                        $cursos = CursoModel::paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);
                        break;
                }
            }else if( isset( $form['q'] )  ){
                $cursos = CursoModel::where('titulo','like','%'.$form['q'].'%')->orWhere('desc','like','%'.$form['q'].'%')->paginate(5)->appends( 'q', $form['q'] );
            }else{
                $cursos = CursoModel::paginate(5);
            }
        } catch (\Throwable $th) {
            return redirect('home');
        }
        

        return view('pages.search',compact('cursos','query','tipos','usos','lenguajes'));
    }

    /**
     * Muestra en la pág. todos los resultados en caso de acceder por navbar
     */
    public function indexSearch(){
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $lenguajes = LenguajeModel::all();

        $cursos = CursoModel::paginate(5);
        return view('pages.search',compact('cursos'));
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
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
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
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->latest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
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
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 1:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 2:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 3:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('lenguaje_id','=',$lng)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 4:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 5:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 6:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('lenguaje_id','=',$lng)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            case 7:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->where('tipo_id','=',$tipo)->where('uso_id','=',$uso)->where('lenguaje_id','=',$lng)->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
            default:
                return CursoModel::where('titulo','LIKE','%'.$q.'%')->oldest()->paginate(5)->appends([
                            'q' => $q,
                            'tip' => $tipo,
                            'uso' => $uso,
                            'lng' => $lng,
                        ]);;
                break;
        }
    }
}
?>