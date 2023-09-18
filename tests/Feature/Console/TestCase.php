<?php

namespace NovaKit\NovaDevTool\Tests\Feature\Console;

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;
use Orchestra\Testbench\Concerns\WithWorkbench;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithPublishedFiles;
    use WithWorkbench;
}
