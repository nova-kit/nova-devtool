<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;

class EnableCommand extends Command
{
    use Concerns\InteractsWithProcess;

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
        $filesystem = new Filesystem();
        $manifest = $this->laravel->make(PackageManifest::class);

        $vendorPublicPath = public_path('vendor/');
        $novaVendorPath = $manifest->vendorPath.'/laravel/nova';

        if (! $filesystem->isDirectory("{$vendorPublicPath}/nova-cached")) {
            $filesystem->makeDirectory("{$vendorPublicPath}/nova-cached");

            $filesystem->copyDirectory("{$vendorPublicPath}/nova", "{$vendorPublicPath}/nova-cached");
            $filesystem->copy(__DIR__.'/stubs/gitignore.stub', "{$vendorPublicPath}/nova-cached/.gitignore");
        }

        $this->executeCommand('npm set progress=false && npm ci', $novaVendorPath);

        $filesystem->copy($novaVendorPath.'/webpack.mix.js.dist', $novaVendorPath.'/webpack.mix.js');

        $this->executeCommand('npm set progress=false && npm run dev', $novaVendorPath);

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return Command::SUCCESS;
    }
}
