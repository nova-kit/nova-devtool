<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Core\GeneratesCode;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:lens', description: 'Create a new lens class')]
class LensGenerator extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected string $type = 'Lens';

    /**
     * Generator processor.
     *
     * @var class-string<\Orchestra\Canvas\Core\GeneratesCode>
     */
    protected string $processor = GeneratesCode::class;

    /**
     * Get the stub file name for the generator.
     */
    public function getStubFileName(): string
    {
        return 'lens.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
    {
        return $rootNamespace.'\Nova\Lens';
    }

    /**
     * Generator options.
     */
    public function generatorOptions(): array
    {
        return [
            'name' => $this->generatorName(),
        ];
    }
}
