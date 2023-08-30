<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Commands\Generator;
use Orchestra\Canvas\Core\GeneratesCode;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:dashboard', description: 'Create a new dashboard')]
class DashboardGenerator extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected string $type = 'Dashboard';

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
        if ($this->generatorName() === 'Main') {
            return 'main-dashboard.stub';
        }

        return 'dashboard.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
    {
        return $rootNamespace.'\Nova\Dashboards';
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
