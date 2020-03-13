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
Route::get('/',function(){
  return view('home');
});
Route::get('/home',function(){
    return view('home');
});
Route::get('/home/faq',function(){
    return view('pages.faq');
});
Route::get('/perfil',function(){
  return view('pages.perfil');
});

/*    ABM:Admin   */
Route::get('/admin/abm','adminController@listAll')->middleware('auth','rol:auth');
Route::post('/crear/usuario','adminController@crearUsuario')->middleware('auth','rol:auth');
Route::post('/admin/crear/tipo','adminController@crearTipo')->middleware('auth','rol:auth');
Route::post('/admin/crear/uso','adminController@crearUso')->middleware('auth','rol:auth');
Route::get('/editar/usuario/{id}','adminController@editarUsuario')->middleware('auth','rol:auth');
Route::get('/editar/curso/{id}','adminController@editarCurso')->middleware('auth','rol:auth');
Route::post('/actualizar/usuario','adminController@actualizarUsuario')->middleware('auth','rol:auth');
Route::post('/actualizar/curso','adminController@actualizarCurso')->middleware('auth','rol:auth');
/*    ABM:Admin   BORRAR  */
Route::post('/borrar/usuario','adminController@borrarUsuario')->middleware('auth','rol:auth');
Route::post('/borrar/tipo','adminController@borrarTipo')->middleware('auth','rol:auth');
Route::post('/borrar/uso','adminController@borrarUso')->middleware('auth','rol:auth');
Route::post('/borrar/curso','adminController@borrarCurso')->middleware('auth','rol:auth');


Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');

/*    Curso   */
Route::get('/curso/todos','cursoController@list');
Route::get('/curso','cursoController@searchCurso');

/*    PERFIL    */
// Route::post('/perfil','cursoController@misCursos');
Route::post('/perfil','cursoController@crearCurso');
Route::get('/perfil','profesorController@listadoTipoUso')->middleware('auth');
/*PERFIL Actualizar Datos*/
Route::post('/actualizarDatos','UserController@actualizarDatos');

/*    CARRITO   */
Route::get('/carrito','CarritoController@mostrarCarrito');
Route::get('/carrito/{id}','CarritoController@agregarAlCarrito');
Route::get('/carritolimpiar','CarritoController@limpiarCarrito');

/*  Login,Register,PasswordReset  */
Auth::routes();
