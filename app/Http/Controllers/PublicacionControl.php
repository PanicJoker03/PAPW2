<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Helper;
use Auth;
use App\Publicacion;
use App\Club;
class PublicacionControl extends Controller
{
    public function crearPublicacion(Request $request)
    {
        $imagen = Image::make($request->file('imagen'));
    	$rutas = Helper::guardarImagen($imagen);
    	
        $club = Club::find($request->club);
    	$publicacion = new Publicacion();
    	$publicacion->autor = Auth::id();
    	$publicacion->club = $club->id;
    	$publicacion->contenidoRuta = $rutas['imagenRuta'];
    	$publicacion->contenidoMinRuta = $rutas['imagenMinRuta'];
    	$publicacion->titulo = $request->titulo;
    	$publicacion->descripcion = $request->descripcion;
        if($club->creador == Auth::id()){
            $publicacion->aprobado = true;
        }
    	$publicacion->save();
    	return 'Club creado';
    }
    public function publicacion($id)
    {
        return Publicacion::find($id);
    }
}