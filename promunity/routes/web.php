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

/*    ABM:Admin   */

/*ABM GET*/
Route::get('/admin/abm','adminController@abm')->middleware('auth','rol:auth');
Route::get('/abm/usuarios','adminController@getUsuarios')->middleware('auth','rol:auth');

Route::get('/abm/usuarios/order','adminController@order')->middleware('auth','rol:auth');
Route::get('/abm/cursos','adminController@getCursos')->middleware('auth','rol:auth');
Route::get('/abm/usos','adminController@getUsos')->middleware('auth','rol:auth');
Route::get('/abm/tipos','adminController@getTipos')->middleware('auth','rol:auth');
Route::get('/abm/cursos-alumnos','adminController@getAlumnosCursos')->middleware('auth','rol:auth');

Route::get('/editar/usuario/{id}','adminController@editarUsuario')->middleware('auth','rol:auth');
Route::get('/editar/curso/{id}','adminController@editarCurso')->middleware('auth','rol:auth');
Route::post('/crear/usuario','adminController@crearUsuario')->middleware('auth','rol:auth');
Route::post('/admin/crear/tipo','adminController@crearTipo')->middleware('auth','rol:auth');
Route::post('/admin/crear/uso','adminController@crearUso')->middleware('auth','rol:auth');
Route::post('/actualizar/curso','adminController@actualizarCurso')->middleware('auth','rol:auth');
/*ACTUALIZAR */
Route::put('/actualizar/usuario/{id}','adminController@actualizarUsuario')->middleware('auth','rol:auth');
Route::put('/actualizar/tipo/{id}','adminController@actualizarTipo')->middleware('auth','rol:auth');
Route::put('/actualizar/uso/{id}','adminController@actualizarUso')->middleware('auth','rol:auth');
/*    ABM:Admin   BORRAR  */
Route::delete('/borrar/usuario/{id}','adminController@borrarUsuario')->middleware('auth','rol:auth');
Route::delete('/borrar/tipo/{id}','adminController@borrarTipo')->middleware('auth','rol:auth');
Route::delete('/borrar/uso/{id}','adminController@borrarUso')->middleware('auth','rol:auth');
Route::delete('/borrar/curso/{id}','adminController@borrarCurso')->middleware('auth','rol:auth');


Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');


/*    Search    */
Route::get('/search','searchController@indexSearch');
Route::get('/search','searchController@searchCurso');


/*    Curso    */
// Route::get('/curso',function(){
//   return view('pages.cursos');
// });

/*    Curso detalle   */
Route::get('/curso/{curso_id}','cursoController@detalle');


/*    PERFIL    */
// Route::post('/perfil','cursoController@misCursos');
Route::post('/perfil','cursoController@crearCurso')->middleware('auth');
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
