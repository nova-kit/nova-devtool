<?php

namespace NovaKit\NovaDevTool;

use Composer\InstalledVersions;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Console\ResourceCommand;
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
            $this->registerResourceCommand();

            $this->commands([
                Console\EnableCommand::class,
                Console\DisableCommand::class,
                // Console\ActionGenerator::class,
                // Console\DashboardGenerator::class,
                // Console\FilterGenerator::class,
                // Console\LensGenerator::class,
                Console\ResourceCommand::class,
            ]);
        }
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceCommand()
    {
        $this->app->singleton(ResourceCommand::class, function ($app) {
            return new Console\ResourceCommand($app['files']);
        });
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
