<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comentario";
    /* Regresa un numero determinado de comentarios a partir de la fecha*/
    public static function comentariosPaginado($publicacion, $paramGuía, $numero = 4){
        $publicaciones = DB::table('comentario')
            ->leftJoin('usuario', 'comentario.usuario', '=', 'usuario.id')
            ->where('publicacion', $publicacion)
            ->where('comentario.created_at', "<", $paramGuía)
            ->where('comentario.activo', true)
            ->select(
                'comentario.*',
                'usuario.avatarMinRuta',
            	'usuario.nombreUsuario')
            ->orderBy('comentario.created_at', 'desc')
            ->take($numero)
            ->get();
        return $publicaciones;
    }
    /*Regresa el comentario con más información del usuario*/
    public function info()
    {
        $comentario = DB::table('comentario')
            ->leftJoin('usuario', 'comentario.usuario', '=', 'usuario.id')
            ->where('comentario.id', $this->id)
            ->select(
                'comentario.*',
                'usuario.avatarMinRuta',
                'usuario.nombreUsuario')
            ->get();
        return $comentario;
    }
}
