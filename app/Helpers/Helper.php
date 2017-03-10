<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Image;
class Helper
{
    public static function guardarImagen($imagen)
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
    public static function procesarImagen($archivo, int $cropW, int $cropH, int $cropX, int $cropY)
    {
        $imagen = Image::make($archivo);
        $imagen->crop($cropW, $cropH, $cropX, $cropY);
        return $imagen;
    }
}