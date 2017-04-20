<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Publicacion;
use App\Usuario;
class Publicacion extends Model
{
    protected $table = 'publicacion';
    public static function publicacionesInicio($usuario_id, string $orderBy = 'id', bool $desc = true){
    	$usuario = Usuario::find($usuario_id);
    	//Clubs propios y subscritos
    	$clubs = $usuario->clubsSubscrito_id() + $usuario->clubs_id();
    	return Publicacion::whereIn('club', $clubs)->orderBy($orderBy, $desc? 'desc' : 'asc')->get();
    }
}
