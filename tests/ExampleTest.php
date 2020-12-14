<?php

namespace LaraToolbox\DatabaseViewer\Tests;

use Orchestra\Testbench\TestCase;
use LaraToolbox\DatabaseViewer\DatabaseViewerServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [DatabaseViewerServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
