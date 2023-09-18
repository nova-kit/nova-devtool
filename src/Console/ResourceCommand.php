<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Canvas\Core\Concerns\CodeGenerator;
use Orchestra\Canvas\Core\Concerns\UsesGeneratorOverrides;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:resource', description: 'Create a new resource class')]
class ResourceCommand extends \Laravel\Nova\Console\ResourceCommand
{
    use CodeGenerator;
    use UsesGeneratorOverrides;

    /**
     * Create a new controller creator command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $this->addGeneratorPresetOptions();
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        return $this->generateCode() ? self::SUCCESS : self::FAILURE;
    }

    /**
     * Run after code successfully generated.
     */
    public function afterCodeHasBeenGenerated(string $className, string $path): void
    {
        $this->callSilent('nova:base-resource', [
            'name' => 'Resource',
            '--preset' => $this->option('preset'),
        ]);
    }

    /**
     * Get the base resource class.
     *
     * @return class-string
     */
    protected function getBaseResourceClass()
    {
        $rootNamespace = $this->generatorPreset()->rootNamespace();

        return "{$rootNamespace}Nova\Resource";
    }

    /**
     * Get the default namespace for the class.
     *
     * @return string
     */
    protected function getModelNamespace()
    {
        return $this->generatorPreset()->modelNamespace();
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->getPathUsingCanvas($name);
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->rootNamespaceUsingCanvas();
    }
}
