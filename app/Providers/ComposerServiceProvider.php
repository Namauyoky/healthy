<?php

namespace healthy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use healthy\Http\ViewComposers\ClientComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        View::composers([

            //si se van a agregar varias rutas al composer
//            'App\Http\ViewComposers\ClientComposer' => ['ruta1','ruta2'],

            //Asignamos que composer corresponde o se va a cargar en cada ruta...
            'healthy\Http\ViewComposers\ClientComposer' => 'clientes/create'
            
            
        
        ]);
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
