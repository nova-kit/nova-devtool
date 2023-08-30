<?php

namespace NovaKit\NovaDevTool;

use Composer\InstalledVersions;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Orchestra\Canvas\Core\Presets\Preset;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Events\InstallStarted;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\EnableCommand::class,
                Console\DisableCommand::class,
            ]);

            Preset::commands([
                Console\ActionGenerator::class,
                Console\DashboardGenerator::class,
                Console\LensGenerator::class,
                Console\ResourceGenerator::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (
            $this->app->runningInConsole()
            && \defined('TESTBENCH_WORKING_PATH')
            && InstalledVersions::isInstalled('orchestra/workbench')
        ) {
            tap($this->app->make('events'), function (EventDispatcher $event) {
                $event->listen(InstallStarted::class, [Listeners\InstallingWorkbench::class, 'handle']);
                $event->listen(InstallEnded::class, [Listeners\InstalledWorkbench::class, 'handle']);
            });
        }
    }
}
