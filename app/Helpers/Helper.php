<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Image;
class Helper
{
	/**	
	*	Función para guardar la imagen en formato cuadrado en tamaño
	*	100x100px y una versión minimalizada de 40x40px
	*	@return	array Regresa un arreglo con el nombre de la ruta donde se
	*	guardo el archivo
	*/
    public static function guardarImagenAvatar($imagen)
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
    public static function recortarImagen($archivo, int $cropW, int $cropH, int $cropX, int $cropY)
    {
        $imagen = Image::make($archivo);
        $imagen->crop($cropW, $cropH, $cropX, $cropY);
        return $imagen;
    }
}