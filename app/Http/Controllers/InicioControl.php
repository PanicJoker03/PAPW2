<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class InicioControl extends Controller
{
    public function indice(Request $request)
    {
    	if($this->existeSesion()){
    		return view('inicio');
    	}
    	else {
    		return view('inicioSesion');
    	}
    }

    private function existeSesion()
    {
    	return Session::exists('usuario');
    }
}