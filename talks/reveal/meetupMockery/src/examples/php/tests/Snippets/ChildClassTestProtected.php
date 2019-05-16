<?php

use Zooroyal\MeetUpExample\Snippets\ChildClass;
use PHPUnit\Framework\TestCase;

class ChildClassTestProtected extends TestCase
{
    /**
     * @test
     */
    public function doesEverything()
    {
// sample(foo)
        $childClass = Mockery::mock('ChildClass')->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $childClass->shouldReceive('doesEverything')
            ->andReturn('some result from parent');

        $childClass->doesOneThing(); // string("some result from parent");
// end-sample
    }
}
