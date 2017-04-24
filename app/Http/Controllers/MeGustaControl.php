<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\MeGusta;
class MeGustaControl extends Controller
{
    public function crearMeGusta(Request $request)
    {
    	$megusta = new MeGusta();
    	$megusta->publicacion = $request->publicacion;
    	$megusta->usuario = Auth::user()->id;
    	$megusta->save();
    	return $megusta;
    }
    public function borrarMeGusta(Request $request, $id)
    {
    	$megusta = MeGusta::find($id);
    	$megusta->activo = false;
    	$megusta->save();
    }
}
