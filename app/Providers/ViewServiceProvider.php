<?php

namespace healthy\Providers;

use Illuminate\Support\ServiceProvider;
use healthy\Http\ViewComposers\MakeModelForm;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //
        $this->app->make('view')->composer(
            ['clientes/create'],
            MakeModelForm::class

        );

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
