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



        $this->info("✅ CRUD para {$model} generado correctamente.");
        if ($fields) {
					    $this->generateMigration($model, $fields);
					    $this->info("🧱 Migración para la tabla '" . \Str::snake(\Str::pluralStudly($model)) . "' creada.");
					}
			// Crear vistas desde stubs
		$views = ['index', 'create', 'edit'];
		foreach ($views as $view) {
		    $stubPath = __DIR__ . "/../../stubs/view.{$view}.stub";
		    $viewContent = File::get($stubPath);
		    $viewContent = str_replace(['{{model}}', '{{viewFolder}}'], [$model, $viewFolder], $viewContent);

		    File::put(resource_path("views/{$viewFolder}/{$view}.blade.php"), $viewContent);
		}
		$this->info("📄 Vistas Blade generadas en resources/views/{$viewFolder}");


    }
	    protected function generateMigration($model, $fields)
	{
	    $table = \Str::snake(\Str::pluralStudly($model));
	    $migrationName = 'create_' . $table . '_table';
	    $timestamp = now()->format('Y_m_d_His');
	    $fileName = $timestamp . '_' . $migrationName . '.php';
	    $path = database_path("migrations/{$fileName}");

	    $fieldLines = '';
	    foreach (explode(',', $fields) as $field) {
	        [$name, $type] = explode(':', $field);
	        $fieldLines .= "            \$table->{$type}('{$name}');\n";
	    }

	    $stub = file_get_contents(__DIR__ . '/../../stubs/migration.stub');
	    $stub = str_replace(['{{table}}', '{{fields}}'], [$table, $fieldLines], $stub);

	    file_put_contents($path, $stub);
	}

}

