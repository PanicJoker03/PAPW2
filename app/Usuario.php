<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class Usuario extends Model implements Authenticatable
{
    protected $table = 'usuario';
    public function clubs()
    {
    	return $this->HasMany('App\Club', 'creador')->where('activo', true);
    }

    public function subscripciones()
    {
        return $this->HasMany('App\Subscripcion', 'usuario')->where('activo', true);
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
