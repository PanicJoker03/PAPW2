<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;
class ViewsControl extends Controller
{
	public function inicio()
	{
		if(Auth::check()){
			$usuario = Auth::user();
			return view('inicio',[
				'usuario' => $usuario,
		        'misClubes' => $usuario->clubs(),
		        'nuevosClubs' => Club::masRecientes(),
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
}
