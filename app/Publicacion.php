<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Publicacion;
use App\Usuario;
class Publicacion extends Model
{
    protected $table = 'publicacion';
    /* Regresa un numero determinado de publicaciones a partir de cierto parametro*/
/*    public function publicacionesPaginado($param, $numero)
    {
        $publicaciones = DB::table('publicacion')
            ->leftJoin('comentario', 'publicacion.id', '=', 'comentario.publicacion')
            ->where('publicacion.club', $this->id)
            ->select(
                'publicacion.*',
                DB::raw("sum(comentario.activo) as comentarios"))
                //DB::raw("count(meGusta.id) as meGusta"))
            ->groupBy('publicacion.id')
            ->orderBy('publicacion.'.$param)
            ->take($numero)
            ->get();
        return $publicaciones;
    }*/

    /*Para los casos en donde se deba de emplear un join es mejor usar el query builder*/
    public function comentariosVista()
    {
    	$comentarios = DB::table('comentario')
    		->join('usuario', 'comentario.usuario', '=', 'usuario.id')
    		->where([
    			'publicacion' => $this->id,
    			'comentario.activo' => true
    			])
    		->get();
    	return $comentarios;
    }
	/* Regresa la publicacion y datos sobre el numero de visitas, likes y comentarios*/
    public function publicacionInfo()
    {

    }
}
