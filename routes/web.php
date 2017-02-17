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
Route::get('/', 'InicioControl@indice');
Route::post('/registrar', 'InicioControl@registrar');
Route::post('/iniciarSesion', 'InicioControl@iniciarSesion');
Route::get('/cerrarSesion', 'InicioControl@cerrarSesion');
Route::post('/crearClub', 'ClubControl@crearClub');