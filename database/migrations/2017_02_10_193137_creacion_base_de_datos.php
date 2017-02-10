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
            $table->increments('idUsuario');
            $table->string('correo', 255);
            $table->string('contrasenia', 255);
            $table->string('nombreUsuario', 255);
            $table->string('avatarRuta', 255);
            $table->string('avatarMinRuta', 255);
            $table->enum('genero', array('Hombre','Mujer'));
            $table->date('fechaNacimiento');
            $table->boolean('activo')->default("1");
        });
        Schema::create('club', function(Blueprint $table){
            $table->increments('idClub');
            $table->integer('creador')->unsigned();
            $table->foreign('creador')->references('idUsuario')->on('usuario');
            $table->string('nombreClub', 255);
            $table->string('descripcion', 255)->nullable();
            $table->string('avatarRuta', 255);
            $table->string('avatarMinRuta', 255);
            $table->datetime('fechaCreacion');
            $table->boolean('activo')->default("1");
        });
        Schema::create('publicacion', function(Blueprint $table){
            $table->increments('idPublicacion');
            $table->integer('autor')->unsigned();
            $table->foreign('autor')->references('idUsuario')->on('usuario');
            $table->integer('club')->unsigned();
            $table->foreign('club')->references('idClub')->on('club');
            $table->string('contenidoRuta', 255);
            $table->string('contenidoMinRuta', 255);
            $table->string('titulo', 255);
            $table->string('descripcion', 255)->nullable();
            $table->datetime('fechaPublicacion');
            $table->boolean('aprobado')->default("0");
            $table->boolean('activo')->default("1");
        });
        //Tablas relacionales
        Schema::create('comentario', function(Blueprint $table){
            $table->increments('idComentario');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('idUsuario')->on('usuario');
            $table->integer('publicacion')->unsigned();
            $table->foreign('publicacion')->references('idPublicacion')->on('publicacion');
            $table->string('comentario', 255);
            $table->datetime('fechaComentario');
            $table->boolean('activo')->default("1");
        });
        Schema::create('meGusta', function(Blueprint $table){
            $table->increments('idMeGusta');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('idUsuario')->on('usuario');
            $table->integer('publicacion')->unsigned();
            $table->foreign('publicacion')->references('idPublicacion')->on('publicacion');
            $table->datetime('fechaMeGusta');
            $table->boolean('activo')->default("1");
        });
        Schema::create('subscripcion', function(Blueprint $table){
            $table->increments('idSubscripcion');
            $table->integer('usuario')->unsigned();
            $table->foreign('usuario')->references('idUsuario')->on('usuario');
            $table->integer('club')->unsigned();
            $table->foreign('club')->references('idClub')->on('club');
            $table->datetime('fechaSubscripcion');
            $table->boolean('activo')->default("1");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuario');
        Schema::drop('club');
        Schema::drop('publicacion');
        Schema::drop('comentario');
        Schema::drop('meGusta');
        Schema::drop('subscripcion');
    }
}
