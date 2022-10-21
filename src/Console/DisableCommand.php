<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class DisableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:devtool-disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable Vue DevTool on Laravel Nova';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $vendorPublicPath = public_path('vendor/');

        if (! $filesystem->isDirectory("{$vendorPublicPath}/nova-cached")) {
            return Command::SUCCESS;
        }

        if ($filesystem->isDirectory("{$vendorPublicPath}/nova")) {
            $filesystem->deleteDirectory("{$vendorPublicPath}/nova");
        }

        $filesystem->delete("{$vendorPublicPath}/nova-cached/.gitignore");
        $filesystem->moveDirectory("{$vendorPublicPath}/nova-cached", "{$vendorPublicPath}/nova");

        return Command::SUCCESS;
    }
}
