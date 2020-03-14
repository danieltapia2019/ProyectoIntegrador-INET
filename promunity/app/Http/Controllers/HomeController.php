<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoModel;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Retorna a la vista los ultimos cursos
     */
    public function listFav(){
        $cursosFav = CursoModel::paginate(4);
        return view('home',compact('cursosFav'));
    }
}
