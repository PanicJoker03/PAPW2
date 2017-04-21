<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;
use App\Http\Middleware\ValidarSesion;
use App\Publicacion;
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
    	$publicacion = Publicacion::find($id);
    	return view('publicacion', [
    		'publicacion' => $publicacion,
    		'comentarios' => $publicacion->comentariosVista()
    		]);
    }
}
