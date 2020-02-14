<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
class CursoController extends Controller
{
    public function listado(){
        $cursos = CursoModel::all();

        return view('index',compact('cursos'));
    }

    public function verCurso($id){
        $curso = CursoModel::where('id','=',$id)->get();

        return view('index',compact('curso'));
    }
}
