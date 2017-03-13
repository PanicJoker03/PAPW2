<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Image;
class Helper
{
	const CARPETA_DE_CARGAS = 'uploads';
	const ANCHO_IMAGEN_MIN = 150;
	const TAMAÑO_IMAGEN_AVATAR = 100;
	const TAMAÑO_IMAGEN_AVATAR_MIN = 40;
	public static function guardarImagen($imagen)
	{
        $rutasImagenes = self::generarRutasImagen($imagen);
        $imagen->save($rutasImagenes['imagenRuta']);
        $imagen->fit(self::ANCHO_IMAGEN_MIN, null, function($constraint){
        	$constraint->upsize();
        });
        $imagen->save($rutasImagenes['imagenMinRuta']);
        return $rutasImagenes;
	}
	//Guardamos cualquier imagen en tamaño TAMAÑO_IMAGEN_AVATAR y TAMAÑO_IMAGEN_AVATAR_MIN
    public static function guardarImagenAvatar($imagen)
    {
        $rutasImagenes = self::generarRutasImagen($imagen);
        $imagen->resize(self::TAMAÑO_IMAGEN_AVATAR, self::TAMAÑO_IMAGEN_AVATAR, function($constraint){
                $constraint->upsize();
            });
        $imagen->save($rutasImagenes['imagenRuta']);
        $imagen->resize(self::TAMAÑO_IMAGEN_AVATAR_MIN, self::TAMAÑO_IMAGEN_AVATAR_MIN);
        $imagen->save($rutasImagenes['imagenMinRuta']);
        return $rutasImagenes;
    }
    //Reescalamos la imagen acorde a los parametros enviados del recorte
    public static function recortarImagen($imagen, int $cropW, int $cropH, int $cropX, int $cropY)
    {
        $imagen->crop($cropW, $cropH, $cropX, $cropY);
        return $imagen;
    }
    //generamos el nombre de las rutas donde se guardaran las imagenes
    private static function generarRutasImagen($imagen)
    {
        $extension = str_replace('image/','.',$imagen->mime());
        $nombreImagen = self::CARPETA_DE_CARGAS.'/'.uniqid();
        $nombreImagenMin = $nombreImagen.'min'.$extension;
        $nombreImagen .=$extension;
        return [
            'imagenRuta' => $nombreImagen,
            'imagenMinRuta' => $nombreImagenMin,
        ];
    }
}