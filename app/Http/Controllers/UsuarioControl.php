<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioControl extends Controller
{
    public function registrar(Request $request)
    {
		//TODO: 
		//	*validación 
		$usuario = new Usuario;
		$usuario->nombreUsuario = $request->usuario;
		$usuario->correo = $request->correo;
		$usuario->contrasenia = $request->contraseña;
		$usuario->fechaNacimiento = $request->nacimiento;
		$usuario->genero = $request->genero;
		$usuario->avatarRuta = 'images/defaultAvatar.png';
		$usuario->avatarMinRuta = 'images/defaultAvatarThumb.png';
		$usuario->save();
		return redirect('/');
    }
}
