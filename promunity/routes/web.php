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
Route::get('/admin/abm','adminController@listAll');
Route::post('/crear/usuario','adminController@crearUsuario');
Route::post('/borrar/usuario','adminController@borrarUsuario');
Route::post('/admin/crear/tipo','adminController@crearTipo');
Route::post('/admin/crear/uso','adminController@crearUso');
Route::get('/editar/usuario/{id}','adminController@editarUsuario');
Route::post('/actualizar/usuario','adminController@actualizarUsuario');
Route::post('/borrar/tipo','adminController@borrarTipo');
Route::post('/borrar/uso','adminController@borrarUso');

Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');

/*    Curso   */
Route::get('/curso/todos','cursoController@list');
Route::get('/curso','cursoController@searchCurso');

/*    PERFIL    */
// Route::post('/perfil','cursoController@misCursos');
Route::post('/perfil','cursoController@crearCurso');
Route::get('/perfil','profesorController@listadoTipoUso');

/*    ABM   */
Route::get('/carrito','CarritoController@mostrarCarrito');
Route::get('/carrito/{id}','CarritoController@agregarAlCarrito');
Route::get('/carritolimpiar','CarritoController@limpiarCarrito');

/*  Login,Register,PasswordReset  */
Auth::routes();

/* CARRITO*/
Route::post('/agregar/{id}','CarritoController@agregarAlCarrito')->name('agregarAlCarrito');
Route::post('/borrar-uno/{id}','CarritoController@borrarUno')->name('borrarUno');
