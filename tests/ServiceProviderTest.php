<?php

namespace Tests;

use AbelHalo\Preference\Preference;

class ServiceProviderTest extends TestCase
{
    public function testContainerMakesPreferenceInstance()
    {
        $this->assertInstanceOf(Preference::class, app(Preference::class));
    }
}
