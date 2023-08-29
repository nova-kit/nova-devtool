<?php

namespace NovaKit\NovaDevTool\Console;

use Orchestra\Canvas\Core\Commands\Generator;
use Orchestra\Canvas\Core\Presets\Preset;

class GeneratorCommand extends Generator
{
    /**
     * Get the stub storage.
     */
    public function getPresetStorage(Preset $preset): ?string
    {
        return $preset->hasCustomStubPath()
            ? $preset->getCustomStubPath()
            : __DIR__.'/../../stubs';
    }

    /**
     * Get the stub file for the generator.
     */
    public function getStubFile(): string
    {
        return $this->getStubFileFromPresetStorage($this->preset, $this->getStubFileName());
    }
}
