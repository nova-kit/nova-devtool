<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

use Orchestra\Canvas\Core\Testing\TestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;

class DashboardGeneratorTest extends TestCase
{
    use WithWorkbench;

    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Dashboards/Main.php',
        'app/Nova/Dashboards/Post.php',
    ];

    /** @test */
    public function it_can_generate_dashboard_file()
    {
        $this->artisan('nova:dashboard', ['name' => 'Post'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Dashboards;',
            'use Laravel\Nova\Dashboard;',
            'class Post extends Dashboard',
        ], 'app/Nova/Dashboards/Post.php');
    }

    /** @test */
    public function it_can_generate_the_main_dashboard_file()
    {
        $this->artisan('nova:dashboard', ['name' => 'Main'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Dashboards;',
            'use Laravel\Nova\Dashboards\Main as Dashboard;',
            'class Main extends Dashboard',
        ], 'app/Nova/Dashboards/Main.php');
    }
}
