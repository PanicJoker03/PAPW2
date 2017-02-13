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
use App\Usuario;
Route::get('/', function () {
    return view('inicioSesion');
});

Route::post('/usuario', function(){
	//TODO: validación
	$usuario = new Usuario;
	$usuario->nombreUsuario = Input::get('usuario');
	$usuario->correo = Input::get('correo');
	$usuario->contrasenia = Input::get('contraseña');
	$usuario->fechaNacimiento = Input::get('nacimiento');
	$usuario->genero = Input::get('genero');
	$usuario->avatarRuta = 'images/defaultAvatar.png';
	$usuario->avatarMinRuta = 'images/defaultAvatarThumb.png';
	$usuario->save();
	return redirect('/');
});