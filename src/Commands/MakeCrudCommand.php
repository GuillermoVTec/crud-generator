<?php

namespace GuillermoVenancioTecUcan\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrudCommand extends Command
{
    // Este define cómo se llama el comando en la consola:
    protected $signature = 'make:crud {name} {--fields=}';

    // Este será el texto que se muestra al usar `php artisan list`
    protected $description = 'Genera automáticamente un CRUD completo para un modelo';

    public function handle()
    {
        // Obtenemos el nombre del modelo (ej: Producto)
        $name = $this->argument('name');

        // Obtenemos los campos opcionales: --fields="nombre:string,precio:decimal"
        $fields = $this->option('fields');

        // Creamos los nombres en distintas formas
        $model = Str::studly($name);            // Producto
        $controller = "{$model}Controller";     // ProductoController
        $viewFolder = Str::snake(Str::plural($model)); // productos

        // Crear carpeta de vistas si no existe
        $viewPath = resource_path("views/{$viewFolder}");
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        // Rutas a los stubs
        $controllerStub = __DIR__ . '/../../stubs/controller.stub';
        $modelStub = __DIR__ . '/../../stubs/model.stub';

        // Creamos el controlador
        $controllerContent = str_replace('{{model}}', $model, File::get($controllerStub));
        File::put(app_path("Http/Controllers/{$controller}.php"), $controllerContent);

        // Creamos el modelo
        $modelContent = str_replace('{{model}}', $model, File::get($modelStub));
        File::put(app_path("Models/{$model}.php"), $modelContent);

        // Creamos la migración si hay campos
        if ($fields) {
            $this->call('make:migration', [
                'name' => "create_{$viewFolder}_table",
                '--create' => $viewFolder,
            ]);
        }

        $this->info("✅ CRUD para {$model} generado correctamente.");
    }
}

