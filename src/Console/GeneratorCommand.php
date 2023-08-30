<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Commands\Generator;
use Orchestra\Canvas\Core\Presets\Preset;

abstract class GeneratorCommand extends Generator
{
    /**
     * Get the stub storage for the preset.
     */
    public function getPresetStorage(Preset $preset): ?string
    {
        return $preset->is('laravel')
            ? $preset->basePath().'/nova'
            : $this->getDefaultPresetStorage($preset);
    }

    /**
     * Get the default stub storage for the preset.
     */
    public function getDefaultPresetStorage(Preset $preset): string
    {
        return __DIR__.'/../../stubs';
    }
}
