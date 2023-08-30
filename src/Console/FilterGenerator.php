<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Commands\Generator;
use Orchestra\Canvas\Core\GeneratesCode;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'nova:filter', description: 'Create a new filter class')]
class FilterGenerator extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected string $type = 'Filter';

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
        if ($this->option('boolean')) {
            return 'boolean-filter.stub';
        } elseif ($this->option('date')) {
            return 'date-filter.stub';
        }

        return 'filter.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
    {
        return $rootNamespace.'\Nova\Filters';
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

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['boolean', null, InputOption::VALUE_NONE, 'Indicates if the generated filter should be a boolean filter'],
            ['date', null, InputOption::VALUE_NONE, 'Indicates if the generated filter should be a date filter'],
        ];
    }
}
