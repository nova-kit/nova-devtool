<?php

namespace NovaKit\NovaDevTool\Processors;

use Illuminate\Support\Str;
use Orchestra\Canvas\Core\GeneratesCode;

/**
 * @property \Orchestra\Canvas\Commands\Database\Factory $listener
 */
class GeneratesResourceCode extends GeneratesCode
{
    /**
     * Build the class with the given name.
     */
    protected function buildClass(string $name): string
    {
        $namespaceModel = ! empty($this->options['model'])
            ? $this->qualifyClass($this->options['model'])
            : trim($this->rootNamespace(), '\\').'\\Model';

        $model = class_basename($namespaceModel);

        $factoryNamespace = $this->preset->factoryNamespace();

        if (Str::startsWith($namespaceModel, 'App\\Models')) {
            $namespace = Str::beforeLast($factoryNamespace.'\\'.Str::after($namespaceModel, 'App\\Models\\'), '\\');
        } else {
            $namespace = $factoryNamespace;
        }

        $replace = [
            '{{ factoryNamespace }}' => $namespace,
            'NamespacedDummyModel' => $namespaceModel,
            '{{ namespacedModel }}' => $namespaceModel,
            '{{namespacedModel}}' => $namespaceModel,
            'DummyModel' => $model,
            '{{ factory }}' => $model,
            '{{factory}}' => $model,
            '{{ model }}' => $model,
            '{{model}}' => $model,
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }
}
