<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

use Orchestra\Canvas\Core\Testing\TestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;

class FilterGeneratorTest extends TestCase
{
    use WithWorkbench;

    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Filters/Post.php',
    ];

    /** @test */
    public function it_can_generate_filter_file()
    {
        $this->artisan('nova:filter', ['name' => 'Post'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Laravel\Nova\Filters\Filter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends Filter',
            'public $component = \'select-filter\';',
        ], 'app/Nova/Filters/Post.php');
    }

    /** @test */
    public function it_can_generate_filter_file_with_boolean_type()
    {
        $this->artisan('nova:filter', ['name' => 'Post', '--boolean' => true])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Laravel\Nova\Filters\BooleanFilter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends BooleanFilter',
        ], 'app/Nova/Filters/Post.php');
    }

    /** @test */
    public function it_can_generate_filter_file_with_date_type()
    {
        $this->artisan('nova:filter', ['name' => 'Post', '--date' => true])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Illuminate\Support\Carbon;',
            'use Laravel\Nova\Filters\DateFilter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends DateFilter',
        ], 'app/Nova/Filters/Post.php');
    }
}
