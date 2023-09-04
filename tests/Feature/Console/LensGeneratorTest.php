<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Canvas\Core\Testing\TestCase;

class LensGeneratorTest extends TestCase
{
    use WithWorkbench;

    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Lenses/Post.php',
    ];

    /** @test */
    public function it_can_generate_lens_file()
    {
        $this->artisan('nova:lens', ['name' => 'Post'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Lenses;',
            'use Laravel\Nova\Http\Requests\LensRequest;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'use Laravel\Nova\Lenses\Lens;',
            'class Post extends Lens',
            'public static function query(LensRequest $request, $query)',
        ], 'app/Nova/Lenses/Post.php');
    }
}
