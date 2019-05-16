<?php
namespace ExampleProject\Tests\Unit\ExamplePackage;

use ExampleProject\ExamplePackage\MyFirstExample;
use PHPUnit\Framework\TestCase;

class MyFirstExampleTest extends TestCase
{
    /**
     * @test
     */
    public function runExampleDividesParameters()
    {
        $firstParameter  = 4;
        $secondParameter = 4;
        $expectedResult  = $firstParameter / $secondParameter;

        $subject = new MyFirstExample();

        $result = $subject->runExample($firstParameter, $secondParameter);

        self::assertSame($expectedResult, $result);
    }
}
