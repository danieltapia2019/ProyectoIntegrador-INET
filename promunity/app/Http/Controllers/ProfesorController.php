<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsoModel;
use App\TipoModel;
class ProfesorController extends Controller
{
    public function listadoTipoUso(){
        $tipos = TipoModel::all();
        $usos = UsoModel::all();
        $vac = compact('tipos','usos');
        return view('pages.perfil',$vac);
    }
}
