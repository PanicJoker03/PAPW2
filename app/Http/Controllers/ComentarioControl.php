<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Comentario;
class ComentarioControl extends Controller
{
    public function crearComentario(Request $request)
    {
        $comentario = new Comentario();
        $comentario->usuario = Auth::user()->id;
        $comentario->publicacion = $request->publicacion;
        $comentario->comentario = $request->comentario;
        $comentario->save();
    	return $comentario->info();
    }
    public function comentariosPaginado(Request $request, $publicacion)
    {
        return Comentario::comentariosPaginado($publicacion, $request->paramGuia, $request->cantidad);
    }
    public function borrar($id)
    {
        $comentario = Comentario::find($id);
        $comentario->activo = false;
        $comentario->save();
    }
}
