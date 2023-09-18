<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

class ResourceCommandTest extends TestCase
{
    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Post.php',
        'app/Nova/Resource.php',
    ];

    /** @test */
    public function it_can_generate_resource_file()
    {
        $this->artisan('nova:resource', ['name' => 'Post', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova;',
            'class Post extends Resource',
            'public static $model = \App\Models\Post::class;',
        ], 'app/Nova/Post.php');

        $this->assertFileContains([
            'namespace App\Nova;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'use Laravel\Nova\Resource as NovaResource;',
            'class Resource extends NovaResource',
        ], 'app/Nova/Resource.php');
    }
}
