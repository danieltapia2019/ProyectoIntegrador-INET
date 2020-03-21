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

/*    Home    */
Route::get('/','HomeController@listFav');
Route::get('/home','HomeController@listFav');
/*    Pages   */
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
Route::delete('/borrar/usuario/{id}','adminController@borrarUsuario')->middleware('auth','rol:auth');
Route::delete('/borrar/tipo/{id}','adminController@borrarTipo')->middleware('auth','rol:auth');
Route::delete('/borrar/uso/{id}','adminController@borrarUso')->middleware('auth','rol:auth');
Route::delete('/borrar/curso/{id}','adminController@borrarCurso')->middleware('auth','rol:auth');
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

/*    Carrito   */
Route::get('/carrito','CarritoController@mostrarCarrito');
Route::get('/carrito/{id}','CarritoController@agregarAlCarrito');
Route::get('/carritolimpiar','CarritoController@limpiarCarrito');

/*  Login,Register,PasswordReset  */
Auth::routes();

/*Settings*/
Route::get('/setting',function(){
  return view('pages.setting');
});
Route::post('/setting','UserController@theme');
