<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
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
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
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
     * @return string
     */
    protected function getPath($name)
    {
        return $this->jsPath(
            $this->getNameInput().'.'.$this->option('extension'),
        );
    }

    /**
     * Get the desired view name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $name = trim($this->argument('name'));

        $name = str_replace(['\\', '.'], '/', $this->argument('name'));

        return $name;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath(
            '/stubs/vue.stub',
        );
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return $this->laravel->basePath(trim($stub, '/'));
    }

    /**
     * Get the js directory path from the application configuration.
     *
     * @param  string  $path
     * @return string
     */
    protected function jsPath($path = '')
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
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['extension', null, InputOption::VALUE_OPTIONAL, 'The extension of the generated component', 'vue'],
            ['page', 'p', InputOption::VALUE_NONE, 'Create the component as a page'],
            ['layout', 'l', InputOption::VALUE_NONE, 'Create the component as a layout'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the component even if the view already exists'],
        ];
    }
}
