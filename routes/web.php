<?php
use App\Publicacion;
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
Route::get('/buscar', 'ViewsControl@buscar');
//Sesión
Route::post('/registrar', 'InicioControl@registrar');
Route::post('/iniciarSesion', 'InicioControl@iniciarSesion');
Route::get('/cerrarSesion', 'InicioControl@cerrarSesion');
//Clubs
Route::group(['prefix' => 'club'], function(){
	Route::post('crear', 'ClubControl@crearClub');
	Route::get('{id}/vista', 'ViewsControl@club');
});
//Subscripción
Route::group(['prefix' => 'subscripcion'], function(){
	Route::post('crear', 'SubscripcionControl@crearSubscripcion');
	Route::post('{id}/borrar', 'SubscripcionControl@borrarSubscripcion');
});
//Publicación
Route::group(['prefix' => 'publicacion'], function(){
	Route::post('crear', 'PublicacionControl@crearPublicacion');
	Route::get('{id}/vista', 'ViewsControl@publicacion');
	Route::post('{id}/aprobar', 'PublicacionControl@aprobarPublicacion');
	Route::post('{id}/rechazar', 'PublicacionControl@rechazarPublicacion');
	//Route::post('{id}/megusta');
	Route::get('inicio', 'PublicacionControl@inicio');
	Route::get('club/{id}/paginado', 'PublicacionControl@publicacionesPaginado');
	Route::get('{id}', 'PublicacionControl@publicacion');
	//Route::get('inicio', 'PublicacionControl@inicio');
});
//Comentario
Route::group(['prefix' => 'comentario'], function(){
	Route::post('crear', 'ComentarioControl@crearComentario');
	Route::post('{id}/borrar', 'ComentarioControl@borrar');
	Route::post('{id}/editar', 'ComentarioControl@editar');
	Route::get('publicacion/{id}/paginado', 'ComentarioControl@comentariosPaginado');
});
//Me gusta
Route::group(['prefix' => 'megusta'], function(){
	Route::post('crear', 'MeGustaControl@crearMeGusta');
	Route::post('{id}/borrar', 'MeGustaControl@borrarMeGusta');
});