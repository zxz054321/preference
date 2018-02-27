<?php

namespace Tests;

use AbelHalo\Preference\Preference;

class PreferenceTest extends TestCase
{
    public function testUseId()
    {
        $this->assertInstanceOf(Preference::class, Preference::useId(1));
    }
}
