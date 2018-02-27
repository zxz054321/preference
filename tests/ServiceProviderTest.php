<?php

namespace Tests;

use AbelHalo\Preference\Preference;

class ServiceProviderTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(Preference::class, app(Preference::class));
    }
}
