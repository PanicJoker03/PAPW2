<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Publicacion;
use App\Usuario;
use App\Visita;
class Publicacion extends Model
{
    protected $table = 'publicacion';
    /* Regresa un numero determinado de publicaciones a partir de cierto parametro*/
    public static function publicacionesPaginado($clubs, $paramGuía = PHP_INT_MAX, $numero = 4, $orderBy = 'id' /*, bool $desc = true*/){
        //$subquery = 'publicacion.' . $orderBy .' > (select '. $orderBy .' from publicacion where publicacion.id >= '. $idGuía .' limit 1)';
        $publicaciones = DB::table('publicacion')
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
            ->get();
        return $publicaciones;
    }
    public static function buscar($string)
    {
        $param = '%'.$string.'%';
        return Publicacion::where(function($query) use($param){
            $query->where('titulo','like', $param)
                ->orWhere('descripcion','like', $param);
        })->where('activo', true)->get();
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
    public function visitas()
    {
        $visitas = Visita::where([
                'publicacion' => $this->id,
                'activo' => true
            ])->count();
        return $visitas;
    }
}
