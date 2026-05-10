<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:vue')]
class VueMakeCommand extends GeneratorCommand
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Vue component';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:vue';

    /**
     * The type of file being generated.
     *
     * @var string
     */
    protected $type = 'Vue component';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     *
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $contents = parent::buildClass($name);

        return str_replace(
            '{{ quote }}',
            Inspiring::quotes()->random(),
            $contents,
        );
    }

    /**
     * Get the destination view path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        return $this->jsPath(
            $this->getNameInput().'.'.$this->option('extension'),
        );
    }

    /**
     * Get the desired view name from the input.
     */
    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));

        $name = str_replace(['\\', '.'], '/', $this->argument('name'));

        return $name;
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath(
            '/stubs/vue.stub',
        );
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return $this->laravel->basePath(trim($stub, '/'));
    }

    /**
     * Get the js directory path from the application configuration.
     */
    protected function jsPath(string $path = ''): string
    {
        $views = match (true) {
            $this->option('page') => resource_path('js/pages'),
            $this->option('layout') => resource_path('js/layouts'),
            default => resource_path('js/components'),
        };

        return $views.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the console command arguments.
     */
    protected function getOptions(): array
    {
        return [
            ['extension', null, InputOption::VALUE_OPTIONAL, 'The extension of the generated component', 'vue'],
            ['page', 'p', InputOption::VALUE_NONE, 'Create the component as a page'],
            ['layout', 'l', InputOption::VALUE_NONE, 'Create the component as a layout'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the component even if the view already exists'],
        ];
    }
}
