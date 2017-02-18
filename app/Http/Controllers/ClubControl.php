<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;
class ClubControl extends Controller
{
    public function crearClub(Request $request)
    {
    	$nombreImagen = uniqid();
    	$request->file('imagen')->move('uploads', $nombreImagen);
    	$club = new Club();
    	$club->creador = Auth::id();
    	$club->nombreClub = $request->nombreClub;
    	$club->descripcion = $request->descripcion;
    	$club->avatarRuta = 'uploads/'.$nombreImagen;
    	$club->avatarMinRuta = 'uploads/'.$nombreImagen;
    	$club->save();
    	return redirect('/');
    }
}
