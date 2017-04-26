<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Subscripcion;
class SubscripcionControl extends Controller
{
    public function crearSubscripcion(Request $request)
    {
    	$subscripcion = new Subscripcion();
    	$subscripcion->club = $request->club;
    	$subscripcion->usuario = Auth::user()->id;
    	$subscripcion->save();
    	return $subscripcion;
    }
    public function borrarSubscripcion(Request $request, $id)
    {
    	$subscripcion = Subscripcion::find($id);
    	$subscripcion->activo = false;
    	$subscripcion->save();
    }
}
