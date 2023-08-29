<?php

namespace NovaKit\NovaDevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\Foundation\Console\Actions\EnsureDirectoryExists;
use Orchestra\Testbench\Foundation\Console\Actions\GeneratesFile;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Workbench;

class InstalledWorkbench
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem;
     */
    public $files;

    /**
     * Construct a new event listener.
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(InstallEnded $event)
    {
        $workingDirectory = realpath(__DIR__.'/../../stubs');

        (new EnsureDirectoryExists(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle([
            Workbench::path('app/Nova'),
            Workbench::path('app/Providers'),
        ]);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            $workingDirectory.DIRECTORY_SEPARATOR.'UserResource.stub',
            Workbench::path('app/Nova/User.php')
        );

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            $workingDirectory.DIRECTORY_SEPARATOR.'NovaServiceProvider.stub',
            Workbench::path('app/Providers/NovaServiceProvider.php')
        );

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            $workingDirectory.DIRECTORY_SEPARATOR.'DatabaseSeeder.stub',
            Workbench::path('database/seeders/DatabaseSeeder.php')
        );
    }
}
