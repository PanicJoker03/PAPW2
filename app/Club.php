<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'club';
    public static function masRecientes()
    {
    	return Club::where('activo', '=', true)->orderBy('created_at', 'desc')->take(5)->get();
    }

    public function publicacionesAprobadas()
    {
        return $this->HasMany('App\Publicacion', 'club')->where([
        		'activo' => true,
        		'aprobado' => true,
        	])->orderBy('created_at','desc');
    }

    public function publicacionesPendientes()
    {
        return $this->HasMany('App\Publicacion', 'club')->where([
        		'activo' => true,
        		'aprobado' => false,
        	]);
    }
}
