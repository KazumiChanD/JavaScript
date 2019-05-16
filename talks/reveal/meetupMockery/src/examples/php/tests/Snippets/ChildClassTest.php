<?php

use PHPUnit\Framework\TestCase;

class ChildClassTest extends TestCase
{
    /**
     * @test
     */
    public function doesEverything()
    {
// sample(foo)
        $childClass = Mockery::mock('ChildClass')->makePartial();

        $childClass->shouldReceive('doesEverything')
            ->andReturn('some result from parent');

        $childClass->doesOneThing(); // string("some result from parent");
// end-sample
    }
}
