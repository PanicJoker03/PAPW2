<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicacionControl extends Controller
{
    public function crearPublicacion(Request $request)
    {
    	return response(201, 'OK');
    }
}