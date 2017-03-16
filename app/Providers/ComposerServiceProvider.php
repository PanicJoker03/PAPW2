<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::creator('barraNavegacion', function($view){
            $usuario = Auth::user();
            $view->with('solicitudes', $usuario->publicacionesPorAprobar()->count());
            $view->with('clubsCount', $usuario->clubs->count());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
