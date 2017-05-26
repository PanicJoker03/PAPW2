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
    public static function buscar($string)
    {
        $param = '%'.$string.'%';
        return Club::where(function($query) use($param){
            $query->where('nombreClub','like', $param)
                ->orWhere('descripcion','like', $param);
        })->where('activo', true)->get();
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
    }
    public function publicacionesPendientes()
    {
        return $this->HasMany('App\Publicacion', 'club')->where([
        		'activo' => true,
        		'aprobado' => false,
        	]);
    }
    public static function ultimaActividad()
    {
/*        $publicaciones = DB::table('publicacion')
            ->leftJoin('comentario', 'publicacion.id', '=', 'comentario.publicacion')
            ->leftJoin('visita', 'publicacion.id', '=', 'visita.publicacion')
            ->leftJoin('megusta', 'publicacion.id', '=', 'megusta.publicacion')
            ->whereIn('club', $clubs)
            ->where('publicacion.'.$orderBy, "<", $paramGuía)
            ->where([
                'publicacion.activo' => true,
                'publicacion.aprobado' => true 
                ])
            //->whereRaw($subquery)
            ->select(
                'publicacion.*',
                DB::raw("count(distinct case when comentario.activo = true then comentario.id else null end) as comentarios"),
                DB::raw("count(distinct case when visita.activo = true then visita.id else null end) as visitas"),
                DB::raw("count(distinct case when megusta.activo = true then megusta.id else null end) as megusta"))
            ->groupBy('publicacion.id')
            ->orderBy('publicacion.'.$orderBy, 'desc')
            ->take($numero)
            ->get();*/
        $club = 23;
        $likes = DB::table('megusta')
            ->leftJoin('publicacion', 'megusta.publicacion', '=', 'publicacion.id')
            ->where([
                'club' => $club,
                'megusta.activo' => true,
                'publicacion.activo' => true
                ])
            ->orderBy('megusta.created_at', 'desc')
            ->pluck('publicacion.id')
            ->toArray();
        $likes = array_unique($likes);
        return $likes;
    }
}
