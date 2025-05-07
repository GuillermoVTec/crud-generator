<?php

namespace GuillermoVenancioTecUcan\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Aquí puedes registrar futuros bindings si lo deseas
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Registro del comando artisan
            $this->commands([
                \GuillermoVenancioTecUcan\CrudGenerator\Commands\MakeCrudCommand::class,
            ]);

            // Permitir publicar los stubs
            $this->publishes([
                __DIR__ . '/../stubs' => base_path('stubs/crud-generator'),
            ], 'crud-stubs');
        }
    }
}

