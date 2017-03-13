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
			return view('inicio',[
				'usuario' => Auth::user(),
		        'misClubes' => Auth::user()->clubs(),
		        'nuevosClubs' => Club::masRecientes()
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
		return view('administrar');
    }
}
