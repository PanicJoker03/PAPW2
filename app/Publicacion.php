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
    public static function publicacionesPaginado($clubs, $paramGuía = PHP_INT_MAX, $numero = 4, string $orderBy = 'id' /*, bool $desc = true*/){
        //$subquery = 'publicacion.' . $orderBy .' > (select '. $orderBy .' from publicacion where publicacion.id >= '. $idGuía .' limit 1)';
        $publicaciones = DB::table('publicacion')
            ->leftJoin('comentario', 'publicacion.id', '=', 'comentario.publicacion')
            ->whereIn('club', $clubs)
            ->where('publicacion.'.$orderBy, "<", $paramGuía)
            ->where('publicacion.activo', true)
            //->whereRaw($subquery)
            ->select(
                'publicacion.*',
                DB::raw("sum(ifnull(comentario.activo,0)) as comentarios"))
            ->groupBy('publicacion.id')
            ->orderBy('publicacion.'.$orderBy, 'desc')
            ->take($numero)
            ->get();
        return $publicaciones;
    }

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
}
