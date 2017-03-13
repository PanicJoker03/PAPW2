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
//TODO: 
//	usar '/club/crear' en vez de 'crearClub'
//VIEWS
Route::get('/', 'ViewsControl@inicio');
Route::get('/administrar', 'ViewsControl@administrar');
Route::get('/club/{id}', 'ViewsControl@club');
//ACCIONES
//Sesión
Route::post('/registrar', 'InicioControl@registrar');
Route::post('/iniciarSesion', 'InicioControl@iniciarSesion');
Route::get('/cerrarSesion', 'InicioControl@cerrarSesion');
//Clubs
Route::post('/club/crear', 'ClubControl@crearClub');
//Subscripción
Route::post('subscripcion/crear', 'SubscripcionControl@crearSubscripcion');
//Publicación
Route::post('/publicacion/crear', 'PublicacionControl@crearPublicacion');