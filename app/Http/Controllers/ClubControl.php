<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Helper;
use Auth;
use App\Club;
use App\Subscripcion;
class ClubControl extends Controller
{
    public function crearClub(Request $request)
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
        
        $club = new Club();
    	$club->creador = Auth::id();
    	$club->nombreClub = $request->nombreClub;
    	$club->descripcion = $request->descripcion;
    	$club->avatarRuta = $rutas['imagenRuta'];
    	$club->avatarMinRuta = $rutas['imagenMinRuta'];
    	$club->save();
    	return $club;
    }
}
