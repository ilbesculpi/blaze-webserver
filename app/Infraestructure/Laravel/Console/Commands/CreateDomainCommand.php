<?php

namespace App\Infraestructure\Laravel\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;

class CreateDomainCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:make {domain}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new DDD Domain';

    public function handle()
    {
        $domain = Str::studly( $this->argument('domain') );
        $this->type = 'Controller';
        $controllerNamespace = $this->getControllerNamespace();
        $this->generateController($domain, $controllerNamespace);
        $this->type = 'Model';
        $modelNamespace = $this->getModelNamespace();
        $this->generateModel($domain, $modelNamespace);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {

        if( $this->type === 'Model' ) {
            $stub = '/stubs/model.stub';
            return $this->resolveStubPath($stub);
        }

        $stub = '/stubs/controller.api.stub';
        return $this->resolveStubPath($stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $domain = $this->getDomain();
        return $rootNamespace."Domain\{$domain}\Http\Controllers\Api";
    }

    protected function getDomain()
    {
        $name = trim($this->argument('domain'));
        return Str::studly($name);
    }

    protected function getControllerNamespace()
    {
        $domain = $this->getDomain();
        $name = $this->getDomain()."Controller";
        $rootNamespace = $this->rootNamespace();
        return $this->getNamespace("{$rootNamespace}Domain\\{$domain}\Http\Controllers\Api\\{$name}");
    }

    protected function getModelNamespace()
    {
        $domain = $this->getDomain();
        $name = $this->getDomain();
        $rootNamespace = $this->rootNamespace();
        return $this->getNamespace("{$rootNamespace}Domain\\{$domain}\Models\\{$name}");
    }

    protected function generateController(string $domain, string $namespace)
    {
        $domain = $this->getDomain();
        $controllerName = "{$domain}Controller";

        $path = $this->getPath("{$namespace}\\{$controllerName}");
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports(
            $this->buildClass($controllerName)
        ));

        $info = $this->type;

        $this->components->info(sprintf('%s [%s] created successfully.', $info, $path));
    }

    protected function generateModel(string $domain, string $namespace)
    {
        $modelName = Str::studly($domain);
        $this->line("Generating model {$namespace}\\{$modelName}...");

        $path = $this->getPath("{$namespace}\\{$modelName}");
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports(
            $this->buildClass($modelName)
        ));

        $info = $this->type;

        $this->components->info(sprintf('%s [%s] created successfully.', $info, $path));
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in the base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $domain = $this->getDomain();
        $rootNamespace = $this->rootNamespace();
        $controllerNamespace = $this->getNamespace("{$rootNamespace}Domain\\{$domain}\Http\Controllers\Api\\{$name}");
        $modelNamespace = $this->getNamespace("{$rootNamespace}Domain\\{$domain}\Models\{$domain}.php");

        $replace = [];
        $class = '';
        if( $this->type === 'Model' ) {
            $replace = $this->buildModelReplacements();
            $class = str_replace(
                array_keys($replace), array_values($replace), parent::buildClass($modelNamespace."\\".$name)
            );
        }
        else if( $this->type === 'Controller' ) {
            $replace = $this->buildControllerReplacements();
            $class = str_replace(
                array_keys($replace), array_values($replace), parent::buildClass($controllerNamespace."\\".$name)
            );
        }

        return $class;
    }


    protected function buildControllerReplacements()
    {
        return [
            '{{ namespace }}' => $this->getControllerNamespace(),
            '{{ model }}' => $this->getDomain(),
            '{{ modelNamespace }}' => $this->getModelNamespace(),
        ];
    }

    protected function buildModelReplacements()
    {
        return [
            '{{ namespace }}' => $this->getModelNamespace(),
            '{{ model }}' => $this->getDomain(),
        ];
    }

    private function createRoutes(string $domain)
    {

    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
                        ? $customPath
                        : __DIR__.$stub;
    }

}
