<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Session;
class UsuarioControl extends Controller
{
	//TODO: reemplazar el uso de la clase request en las funciones privadas
	//por array...
    public function registrar(Request $request)
    {
		//TODO: 
		//	*validación de campos
		$usuario = $this->crearUsuario($request);
		$this->crearSesion($usuario);
		return redirect('/');
    }

	public function iniciarSesion(Request $request)
	{
		//TODO: 
		//	*validación de campos
		$usuario = $this->existeUsuario($request);
		if($usuario != null)
			$this->crearSesion($usuario);
		return redirect('/');
	}

	private function crearUsuario(Request $request)
	{
		$usuario = new Usuario;
		$usuario->nombreUsuario = 	$request->usuario;
		$usuario->correo = 			$request->correo;
		$usuario->contrasenia = 	$request->contraseña;
		$usuario->fechaNacimiento = $request->nacimiento;
		$usuario->genero = 			$request->genero;
		$usuario->avatarRuta = 		'images/defaultAvatar.png';
		$usuario->avatarMinRuta = 	'images/defaultAvatarThumb.png';
		$usuario->save();
		return $usuario;
	}

	private function crearSesion(Usuario $usuario)
	{
		Session::put('usuario', $usuario->id);
	}

	private function existeUsuario(Request $request)
	{
		return Usuario::where('nombreUsuario',$request->usuario)
							->where('contrasenia', $request->contraseña)
							->first();
	}
}
