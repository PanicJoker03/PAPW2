<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Image;
use Auth;
use App\Club;
use App\Subscripcion;
class ClubControl extends Controller
{
    public function crearClub(Request $request)
    {
        $imagen = Helper::recortarImagen(
            $request->file('imagen'),
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
