<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Helper;
use Auth;
use App\Publicacion;
class PublicacionControl extends Controller
{
    public function crearPublicacion(Request $request)
    {
        $imagen = Image::make($request->file('imagen'));
    	$rutas = Helper::guardarImagen($imagen);
    	
    	$publicacion = new Publicacion();
    	$publicacion->autor = Auth::id();
    	$publicacion->club = $request->club;
    	$publicacion->contenidoRuta = $rutas['imagenRuta'];
    	$publicacion->contenidoMinRuta = $rutas['imagenMinRuta'];
    	$publicacion->titulo = $request->titulo;
    	$publicacion->descripcion = $request->descripcion;
    	$publicacion->save();
    	return 'Club creado';
    }
}