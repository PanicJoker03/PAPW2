<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class Usuario extends Model implements Authenticatable
{
    protected $table = 'usuario';
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
    //TODO: Poner columna en la entidad
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
