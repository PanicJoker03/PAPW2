<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionBaseDeDatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
        *   Creando toda la estructura de la base de datos, solo creamos tablas
        *   y asignamos llaves foraneas.
        */
        //Tablas de entidades
        Schema::create('usuario', function(Blueprint $table){
            $table->increments('id');
            $table->string('correo', 255);
            $table->string('contrasenia', 255);
            $table->string('nombreUsuario', 255);
            $table->string('avatarRuta', 255);
            $table->string('avatarMinRuta', 255);
            $table->enum('genero', array('Hombre','Mujer'));
            $table->date('fechaNacimiento');
            //$table->datetime('fechaRegistro');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
        Schema::create('club', function(Blueprint $table){
            $table->increments('id');
            $table->integer('creador')->unsigned();
            $table->foreign('creador')->references('id')->on('usuario');
            $table->string('nombreClub', 255);
            $table->string('descripcion', 255)->nullable();
            $table->string('avatarRuta', 255);
            $table->string('avatarMinRuta', 255);
            //$table->datetime('fechaCreacion');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
        Schema::create('publicacion', function(Blueprint $table){
            $table->increments('id');
            $table->integer('autor')->unsigned();
            $table->foreign('autor')->references('id')->on('usuario');
            $table->integer('club')->unsigned();
            $table->foreign('club')->references('id')->on('club');
            $table->string('contenidoRuta', 255);
            $table->string('contenidoMinRuta', 255);
            $table->string('titulo', 255);
            $table->string('descripcion', 255)->nullable();
            //$table->datetime('fechaPublicacion');
            $table->timestamps();
            $table->boolean('aprobado')->default("0");
            $table->boolean('activo')->default('1');
        });
        //Tablas relacionales
        Schema::create('visita', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('usuario');
            $table->integer('publicacion')->unsigned();
            $table->foreign('publicacion')->references('id')->on('publicacion');
            //$table->datetime('fechaVisita');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
        Schema::create('comentario', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('usuario');
            $table->integer('publicacion')->unsigned();
            $table->foreign('publicacion')->references('id')->on('publicacion');
            $table->string('comentario', 255);
            //$table->datetime('fechaComentario');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
        Schema::create('meGusta', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('usuario');
            $table->integer('publicacion')->unsigned();
            $table->foreign('publicacion')->references('id')->on('publicacion');
            //$table->datetime('fechaMeGusta');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
        Schema::create('subscripcion', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('usuario');
            $table->integer('club')->unsigned();
            $table->foreign('club')->references('id')->on('club');
            //$table->datetime('fechaSubscripcion');
            $table->timestamps();
            $table->boolean('activo')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Borrar las tablas en orden inverso de creación para no tener
        //problemas con los rollbacks de las migraciones
        Schema::drop('subscripcion');
        Schema::drop('meGusta');
        Schema::drop('comentario');
        Schema::drop('visita');
        Schema::drop('publicacion');
        Schema::drop('club');
        Schema::drop('usuario');
    }
}
