<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;
use App\Http\Middleware\ValidarSesion;
use App\Publicacion;
use App\Comentario;
use App\Visita;
class ViewsControl extends Controller
{
	public function __construct(){
		$this->middleware(ValidarSesion::class, ['except' => ['inicio']]);
	}
	public function inicio()
	{
		if(Auth::check()){
			$usuario = Auth::user();
			return view('inicio',[
				'usuario' => $usuario,
		        'misClubes' => $usuario->clubs(),
		        'nuevosClubs' => Club::masRecientes()
		        //'publicaciones' => $usuario->publicacionesInicioPaginado()//Publicacion::publicacionesInicioPaginado($usuario->id, 0)
		        ]);
		}
		else {
			return view('inicioSesion');
		}
	}
	public function club(int $id)
	{
		$club = Club::find($id);
		return view('club',[
			'club' => $club,
			'publicaciones' => $club->publicacionesAprobadas
			]);
	}
    public function administrar()
    {
    	$usuario = Auth::user();
		return view('administrar', [
			'clubs' => $usuario->clubs('nombreClub')->get(),
			'publicacionesPorAprobar' => $usuario->publicacionesPorAprobar,
			]);
    }
    public function publicacion($id)
    {
    	$usuario = Auth::user();
    	//Crear un visto
    	$visto = new Visita();
    	$visto->usuario = $usuario->id;
    	$visto->publicacion = $id;
    	$visto->save();
    	//
    	$publicacion = Publicacion::find($id);
    	return view('publicacion', [
    		'publicacion' => $publicacion,
    		'club' => Club::find($publicacion->club),
    		'megusta' => $usuario->publicacionMegusta($publicacion->id)
    		//'comentarios' => Comentario::comentariosPaginado($publicacion->id)//$publicacion->comentariosVista()
    		]);
    }
}
