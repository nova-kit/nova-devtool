<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;

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
        $manifest = $this->laravel->make(PackageManifest::class);

        $vendorPublicPath = public_path('vendor/');
        $novaVendorPath = $manifest->vendorPath.'/laravel/nova';

        if (! $filesystem->isDirectory("{$novaVendorPath}/public-cached")) {
            return Command::SUCCESS;
        }

        if ($filesystem->isDirectory("{$vendorPublicPath}/nova")) {
            $filesystem->deleteDirectory("{$vendorPublicPath}/nova");
        }

        $filesystem->delete("{$novaVendorPath}/public-cached/.gitignore");
        $filesystem->moveDirectory("{$novaVendorPath}/public-cached", "{$vendorPublicPath}/nova");

        return Command::SUCCESS;
    }
}
