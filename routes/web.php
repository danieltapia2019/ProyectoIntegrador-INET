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
Route::get('/faq',function(){
    return view('pages.faq');
});

/*    ABM:Admin   */

/*ABM GET*/
Route::get('/admin/abm','adminController@indexAbm')->middleware('auth','rol:auth');

Route::get('/abm/usuarios','adminController@getUsuarios')->middleware('auth','rol:auth');
Route::get('/abm/cursos','adminController@getCursos')->middleware('auth','rol:auth');
Route::get('/abm/usos','adminController@getUsos')->middleware('auth','rol:auth');
Route::get('/abm/tipos','adminController@getTipos')->middleware('auth','rol:auth');
Route::get('/abm/transacciones','adminController@getTransacciones')->middleware('auth','rol:auth');
Route::post('/activar/{id}','adminController@activarCurso')->name('activarCurso');
//Route::get('/abm/cursos-alumnos','adminController@getAlumnosCursos')->middleware('auth','rol:auth');
Route::get('/abm/lenguajes','adminController@getLenguajes')->middleware('auth','rol:auth');
Route::get('/abm/consultas','ConsultaController@getConsultas')->middleware('auth','rol:auth');

Route::get('/editar/usuario/{id}','adminController@editarUsuario')->middleware('auth','rol:auth');
Route::get('/editar/curso/{id}','adminController@editarCurso')->middleware('auth','rol:auth');
Route::post('/crear/usuario','adminController@crearUsuario')->middleware('auth','rol:auth');
Route::post('/admin/crear/tipo','adminController@crearTipo')->middleware('auth','rol:auth');
Route::post('/admin/crear/uso','adminController@crearUso')->middleware('auth','rol:auth');
Route::post('/admin/crear/lenguaje','adminController@crerLenguaje')->middleware('auth','rol:auth');
Route::post('/actualizar/curso','adminController@actualizarCurso')->middleware('auth','rol:auth');
/*ACTUALIZAR */
Route::put('/actualizar/usuario/{id}','adminController@actualizarUsuario')->middleware('auth','rol:auth');
Route::put('/actualizar/tipo/{id}','adminController@actualizarTipo')->middleware('auth','rol:auth');
Route::put('/actualizar/uso/{id}','adminController@actualizarUso')->middleware('auth','rol:auth');
Route::put('/actualizar/lenguaje/{id}','adminController@actualizarLenguaje')->middleware('auth','rol:auth');
/*    ABM:Admin   BORRAR  */
Route::delete('/borrar/usuario/{id}','adminController@borrarUsuario')->middleware('auth','rol:auth');
Route::delete('/borrar/tipo/{id}','adminController@borrarTipo')->middleware('auth','rol:auth');
Route::delete('/borrar/uso/{id}','adminController@borrarUso')->middleware('auth','rol:auth');
Route::delete('/borrar/curso/{id}','adminController@borrarCurso')->middleware('auth','rol:auth');
Route::delete('/abm/consultas/borrar','ConsultaController@deleteConsulta')->middleware('auth','rol:auth');
Route::delete('/borrar/lenguaje/{id}','adminController@borrarLenguaje')->middleware('auth','rol:auth');

Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');


/*    Search    */
Route::get('/search','searchController@indexSearch');
Route::get('/search','searchController@searchCurso');


/*    Curso Alumno   */
Route::get('/{usuario}/{curso}','CursoAlumnoController@indexCurso')->middleware('auth');
//Route::get('/usuario/curso','UserController@indexCurso');

/* Alumnos */
Route::get('/alumnos/curso/{id}','cursoController@alumnosCurso')->middleware('auth','rol:profesor');

/*    Curso detalle   */
Route::get('/curso/{curso_id}','cursoController@detalle');

/*    PERFIL    */
// Route::post('/perfil','cursoController@misCursos');
Route::post('/perfil','cursoController@crearCurso')->middleware('auth');
Route::get('/perfil','UserController@miPerfil')->middleware('auth');
Route::post('/opinion','UserController@darOpinion')->middleware('auth');

/*PERFIL Actualizar Datos*/
Route::post('/actualizarDatos','UserController@actualizarDatos')->middleware('auth');

/*    Carrito   */
Route::post('/agregar/{id}','CarritoController@agregarAlCarrito')->name('agregarAlCarrito');
Route::post('/borrar-uno/{id}','CarritoController@borrarUno')->name('borrarUno');
Route::get('/pagar','CarritoController@pagar')->name('pagar');
Route::get('/exito',function(){
    return view('pages.exito');
});
Route::get('/carrito','CarritoController@mostrarCarrito');
/*  Login,Register  */
Auth::routes();

/*    Consulta    */
Route::post('/anon','ConsultaController@insertarConsulta');


Route::get('/error',function(){
    return view('pages.pageError');
});
