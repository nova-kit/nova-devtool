<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Core\GeneratesCodeWithEloquent;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'nova:resource', description: 'Create a new resource class')]
class ResourceGenerator extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected string $type = 'Resource';

    /**
     * Generator processor.
     *
     * @var class-string<\Orchestra\Canvas\Core\GeneratesCode>
     */
    protected string $processor = GeneratesCodeWithEloquent::class;

    /**
     * Get the stub file name for the generator.
     */
    public function getStubFileName(): string
    {
        return 'resource.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
    {
        return $rootNamespace.'\Nova';
    }

    /**
     * Generator options.
     */
    public function generatorOptions(): array
    {
        $name = $this->generatorName();

        return [
            'name' => $name,
            'model' => $this->option('model') ?? $name,
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_REQUIRED, 'The model class being represented.'],
        ];
    }
}
