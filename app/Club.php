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
}
