<?php

namespace Tests;

use AbelHalo\Preference\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
