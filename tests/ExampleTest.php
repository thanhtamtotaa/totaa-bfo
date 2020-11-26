<?php

namespace Totaa\TotaaBfo\Tests;

use Orchestra\Testbench\TestCase;
use Totaa\TotaaBfo\TotaaBfoServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TotaaBfoServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
