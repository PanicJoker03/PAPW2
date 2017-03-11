<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario;
use App\Club;
class InicioControl extends Controller
{
    public function registrar(Request $request)
    {
        //TODO: 
        //  *validación de campos
        $usuario = new Usuario();
        $usuario->nombreUsuario = $request->usuario;
        $usuario->correo = $request->correo;
        $usuario->contrasenia = bcrypt($request->contraseña);
        $usuario->avatarRuta = 'images/defaultAvatar.png';
        $usuario->avatarMinRuta = 'images/defaultAvatarThumb.png';
        $usuario->genero = $request->genero;
        $usuario->fechaNacimiento = $request->nacimiento;
        $usuario->save();
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