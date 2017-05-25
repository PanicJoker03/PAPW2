<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario;
use App\Club;
use Helper;
use Image;
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

    public function editarUsuario(Request $request)
    {
        
        $user = Auth::user();
        $user->nombreUsuario = $request->nombreUsuario;
        $user->correo = $request->correo;
        $user->genero = $request->genero;
        $user->fechaNacimiento = $request->fechaNacimiento;
        if($request->file('imagen'))
        {
            $imagen = Image::make($request->file('imagen'));
            Helper::recortarImagen(
                $imagen,
                $request->cropW,
                $request->cropH,
                $request->cropX,
                $request->cropY
            );
            $rutas = Helper::guardarImagenAvatar($imagen);
            $user->avatarRuta = $rutas['imagenRuta'];
            $user->avatarMinRuta = $rutas['imagenMinRuta'];
        }
        $user->save();
        return $user;
    }
}