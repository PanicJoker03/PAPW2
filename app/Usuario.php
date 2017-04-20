<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Club;
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
