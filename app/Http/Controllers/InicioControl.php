<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioControl extends Controller
{
    public function indice()
    {
    	//TODO: Crear redirección si existe una sesión
    	return view('inicioSesion');
    }
}