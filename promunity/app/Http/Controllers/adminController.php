<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\CategoriaModel;
use App\User;

class adminController extends Controller
{
    public function listAll(){
        $alumnos = User::where('acceso','=','2')->get();
        $profesores = User::where('acceso','=','1')->get();
        $admins = User::where('acceso','=','0')->get();

        $cursos = CursoModel::all();
        // $categorias = CategoriaModel::all();
        $vac = compact('alumnos','profesores','admins','cursos');
        return view('pages.abm',$vac);
    }
}
