<?php
namespace ExampleProject\ExamplePackage\Tests\Unit;

use ExampleProject\ExamplePackage\MyFifthExample;
use PHPUnit\Framework\TestCase;

class MyFifthExampleTest extends TestCase
{
    public function testRunExampleIGuess()
    {
        $this->markTestIncomplete('Still not sure about the Parameters of runExample()');

        $subject = new MyFifthExample();

        $subject->runExample(3, 0);
    }
}
