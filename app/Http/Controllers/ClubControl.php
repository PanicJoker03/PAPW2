<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Helpers;
use Image;
use Auth;
use App\Club;
use App\Subscripcion;
class ClubControl extends Controller
{
    public function crearClub(Request $request)
    {
        $imagen = Helper::procesarImagen(
            $request->file('imagen'),
            $request->cropW,
            $request->cropH,
            $request->cropX,
            $request->cropY
        );
        $rutas = Helper::guardarImagen($imagen);
        
        $club = new Club();
    	$club->creador = Auth::id();
    	$club->nombreClub = $request->nombreClub;
    	$club->descripcion = $request->descripcion;
    	$club->avatarRuta = $rutas['imagenRuta'];
    	$club->avatarMinRuta = $rutas['imagenMinRuta'];
    	$club->save();
    	return $club;
    }

    private function guardarImagen($imagen)
    {
        $extension = str_replace('image/','.',$imagen->mime());
        $nombreImagen = 'uploads/'.uniqid();
        $nombreImagenMin = $nombreImagen.'min'.$extension;
        $nombreImagen .=$extension;
        $imagen->resize(100, 100, function($constraint){
                $constraint->upsize();
            });
        $imagen->save($nombreImagen);
        $imagen->resize(40, 40);
        $imagen->save($nombreImagenMin);
        return [
            'imagenRuta' => $nombreImagen,
            'imagenMinRuta' => $nombreImagenMin,
        ];
    }
    //Reescalamos la imagen acorde a los parametros enviados del recorte
    private function procesarImagen($archivo, int $cropW, int $cropH, int $cropX, int $cropY)
    {
        $imagen = Image::make($archivo);
        $imagen->crop($cropW, $cropH, $cropX, $cropY);
        return $imagen;
    }
}
