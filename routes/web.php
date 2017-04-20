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
//La consulta se maneja en get
//La creación/modificacion en post
Route::get('/', 'ViewsControl@inicio');
Route::get('/administrar', 'ViewsControl@administrar');
//Sesión
Route::post('/registrar', 'InicioControl@registrar');
Route::post('/iniciarSesion', 'InicioControl@iniciarSesion');
Route::get('/cerrarSesion', 'InicioControl@cerrarSesion');
//Clubs
Route::group(['prefix' => 'club'], function(){
	Route::post('crear', 'ClubControl@crearClub');
	Route::get('{id}', 'ViewsControl@club');
});
//Subscripción
Route::group(['prefix' => 'subscripcion'], function(){
	//Route::post('crear', 'SubscripcionControl@crearSubscripcion');
});
//Publicación
Route::group(['prefix' => 'publicacion'], function(){
	Route::post('crear', 'PublicacionControl@crearPublicacion');
	Route::post('aprobar/{id}', 'PublicacionControl@aprobarPublicacion');
	Route::post('rechazar/{id}', 'PublicacionControl@rechazarPublicacion');
	Route::get('{id}', 'PublicacionControl@publicacion');
});