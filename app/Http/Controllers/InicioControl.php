<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
class InicioControl extends Controller
{
    public function indice(Request $request)
    {
    	if(Auth::check()){
    		return view('inicio');
    	}
    	else {
    		return view('inicioSesion');
    	}
    }

    public function registrar(Request $request)
    {
        //TODO: 
        //  *validación de campos
        $usuario = Usuario::create([
            'nombreUsuario' => $request->usuario,
            'correo' => $request->correo,
            'contrasenia' => bcrypt($request->contraseña),
            'genero' => $request->genero,
            'fechaNacimiento' => $request->nacimiento
        ]);
        Auth::login($usuario);
        return redirect('/');
    }

    public function iniciarSesion(Request $request)
    {
        //TODO: 
        //  *validación de campos
        $informacionUsuario = ['nombreUsuario' => $request->usuario, 'password' => $request->contraseña];
        Auth::attempt($informacionUsuario);
        return redirect('/');
    }

    public function cerrarSesion()
    {
        Auth::logout();
        return redirect('/');
    }
}