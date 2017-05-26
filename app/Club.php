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
    public function ultimaActividad()
    {
        $megusta = DB::table('megusta')
            ->leftJoin('publicacion', 'megusta.publicacion', '=', 'publicacion.id')
            ->where([
                'club' => $this->id,
                'megusta.activo' => true,
                'publicacion.activo' => true
                ])
            ->select("publicacion.id", "megusta.created_at AS fecha");

        $result = DB::table('comentario')
            ->leftJoin('publicacion', 'comentario.publicacion', '=', 'publicacion.id')
            ->where([
                'club' => $this->id,
                'comentario.activo' => true,
                'publicacion.activo' => true
                ])
            ->select("publicacion.id", "comentario.created_at AS fecha")
            ->union($megusta)
            ->orderBy('fecha', 'desc')
            ->get();
        $result = $result->unique("id")->take(5)->pluck("id")->toArray();
        $publicaciones = collect();
        foreach ($result as $id) {
            $publicaciones->push(Publicacion::find($id));
        }
        return $publicaciones;
    }
}
