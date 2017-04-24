<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Club;
use App\Publicacion;
class Usuario extends Model implements Authenticatable
{
    protected $table = 'usuario';
    public function clubs(string $orderBy = 'id', bool $desc = false)
    {
        return $this->HasMany('App\Club', 'creador')->where('activo', true)->orderBy($orderBy, $desc? 'desc' : 'asc');
    }

    public function clubs_id()
    {
        return $this->HasMany('App\Club', 'creador')->where('activo', true)->pluck('id')->toArray();
    }

    //Solo regresa los id's
    public function clubsSubscrito_id()
    {
        return $this->HasMany('App\Subscripcion', 'usuario')->where('activo', true)->pluck('id')->toArray();
    }

    public function publicacionesPorAprobar()
    {
        return $this->HasManyThrough('App\Publicacion', 'App\Club', 'creador', 'club')
            ->where([
                'publicacion.activo' => true,
                'aprobado' => false,
            ])->orderBy('publicacion.created_at','desc');
    }
    /* Regresa un numero determinado de publicaciones a partir de cierto parametro*/
    public function publicacionesInicioPaginado($paramGuía = PHP_INT_MAX, $numero = 4, string $orderBy = 'id' /*, bool $desc = true*/){
        //Clubs propios y subscritos
        $clubs = $this->clubsSubscrito_id() + $this->clubs_id();
        $publicaciones = Publicacion::publicacionesPaginado($clubs, $paramGuía, $numero, $orderBy);
        return $publicaciones;
    }
    public function publicacionMeGusta($publicacion)
    {
        $megusta = Publicacion::find($publicacion)
            ->hasMany('App\MeGusta', 'publicacion')
            ->where([
                'activo' => true,
                'usuario' => $this->id])
            ->first();
        return $megusta;
    }
    public function getAuthIdentifierName()
    {
    	return $this->nombreUsuario;
    }

    public function getAuthIdentifier()
    {
    	return $this->id;
    }

    public function getAuthPassword()
    {
    	return $this->contrasenia;
    }
    //TODO: Poner columna del token en la entidad
    public function getRememberToken()
    {

    }

    public function setRememberToken($value)
    {

    }

    public function getRememberTokenName()
    {

    }
}
