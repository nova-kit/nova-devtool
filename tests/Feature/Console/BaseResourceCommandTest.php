<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

class BaseResourceCommandTest extends TestCase
{
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
        $this->artisan('nova:base-resource', ['name' => 'Resource', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'use Laravel\Nova\Resource as NovaResource;',
            'class Resource extends NovaResource',
        ], 'app/Nova/Resource.php');
    }
}
