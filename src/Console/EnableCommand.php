<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;

class EnableCommand extends Command
{
    use Concerns\InteractsWithProcess,
        ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:devtool-enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable Vue DevTool on Laravel Nova';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return Command::FAILURE;
        }

        $filesystem = new Filesystem();
        $manifest = $this->laravel->make(PackageManifest::class);
        $novaVendorPath = $manifest->vendorPath.'/laravel/nova';

        if ($filesystem->isDirectory("{$novaVendorPath}/public-cached")) {
            if ($filesystem->isDirectory("{$novaVendorPath}/public")) {
                $filesystem->deleteDirectory("{$novaVendorPath}/public");
            }

            $filesystem->delete("{$novaVendorPath}/public-cached/.gitignore");
            $filesystem->copyDirectory("{$novaVendorPath}/public-cached", "{$novaVendorPath}/public");
            $filesystem->deleteDirectory("{$novaVendorPath}/public-cached");
        }

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return Command::SUCCESS;
    }
}
