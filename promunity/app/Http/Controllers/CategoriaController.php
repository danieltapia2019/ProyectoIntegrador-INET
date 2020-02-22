<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CategoriaModel;

class CategoriaController extends Controller
{
    public function listCategorias(){
      $categorias = CategoriaModel::all();
      return view('pages.perfil',compact('categorias'));
    }
}
