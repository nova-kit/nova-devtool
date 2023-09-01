<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

use Orchestra\Canvas\Core\Testing\TestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;

class ResourceGeneratorTest extends TestCase
{
    use WithWorkbench;

    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Post.php',
    ];

    /** @test */
    public function it_can_generate_resource_file()
    {
        $this->artisan('nova:resource', ['name' => 'Post'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova;',
            'class Post extends Resource',
            'public static $model = \App\Models\Post::class;',
        ], 'app/Nova/Post.php');
    }
}
