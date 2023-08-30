<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Commands\Generator;
use Orchestra\Canvas\Core\GeneratesCode;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'nova:action', description: 'Create a new action class')]
class ActionGenerator extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected string $type = 'Action';

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
        $extension = $this->option('queued') ? 'queued.stub' : 'stub';

        if ($this->option('destructive')) {
            return "destructive-action.{$extension}";
        }

        return "action.{$extension}";
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
    {
        return $rootNamespace.'\Nova\Actions';
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
            ['destructive', null, InputOption::VALUE_NONE, 'Indicate that the action deletes / destroys resources'],
            ['queued', null, InputOption::VALUE_NONE, 'Indicates the action should be queued'],
        ];
    }
}
