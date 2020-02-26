<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home',function(){
    return view('home');
});

Route::get('/home/faq',function(){
    return view('pages.faq');
});

Route::get('/perfil',function(){
  return view('pages.perfil');
});

Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');
// Route::get('/index/{id}','CursoController@verCurso');

// Curso
Route::get('/curso/todos','cursoController@list');
// Route::get('/curso/categoria','cursoController@byCategories');
Route::get('/curso','cursoController@searchCurso');
Route::get('/perfil','CategoriaController@listCategorias');
Route::post('/perfil','cursoController@crearCurso');
Route::get('/perfil/{id}','cursoController@misCursosProfesor');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/carrito','CarritoController@mostrarCarrito');
Route::get('/carrito/{id}','CarritoController@agregarAlCarrito');
Route::get('/carritolimpiar','CarritoController@limpiarCarrito');
