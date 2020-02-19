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

Route::get('/logout','\App\http\Controller\Auth\LoginController@logout');
// Route::get('/index/{id}','CursoController@verCurso');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
