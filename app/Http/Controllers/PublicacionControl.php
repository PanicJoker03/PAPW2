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
        //aprobar instantaneamente si la publicación es del creador
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
    public function aprobarPublicacion($id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->aprobado = true;
        $publicacion->save();
    }
    public function rechazarPublicacion($id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->activo = false;
        $publicacion->save();
    }
    public function inicio(Request $request)
    {
        return Auth::user()->publicacionesInicioPaginado($request->paramGuia, $request->cantidad);
    }
    public function publicacionesPaginado(Request $request, $club)
    {
        return Publicacion::publicacionesPaginado([$club], $request->paramGuia, $request->cantidad);
    }
}