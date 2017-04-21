<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Club extends Model
{
    protected $table = 'club';
    public static function masRecientes()
    {
    	return Club::where('activo', '=', true)->orderBy('created_at', 'desc')->take(5)->get();
    }
    /* Esta función puede quedar en desuso*/
    public function publicacionesAprobadas()
    {
        return $this->HasMany('App\Publicacion', 'club')->where([
        		'activo' => true,
        		'aprobado' => true,
        	])->orderBy('created_at','desc');
    }
    /* Regresa un numero determinado de publicaciones a partir de cierto parametro*/
    public function publicacionesPaginado($param, $numero)
    {
        $publicaciones = DB::table('publicacion')
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
    }
    public function publicacionesPendientes()
    {
        return $this->HasMany('App\Publicacion', 'club')->where([
        		'activo' => true,
        		'aprobado' => false,
        	]);
    }
}
