<?php
namespace ExampleProject\Tests\Unit\ExamplePackage;

use ExampleProject\ExamplePackage\MyFirstExample;
use ExampleProject\ExamplePackage\MySecondExample;
use PHPUnit\Framework\TestCase;

class MySecondExampleTest extends TestCase
{
    /** @var MySecondExample */
    private $subject;

    protected function setUp()
    {
        $this->subject = new MySecondExample();
    }

    /**
     * @test
     */
    public function runExampleDividesParameters()
    {
        $firstParameter  = 8;
        $secondParameter = 4;
        $expectedResult  = $firstParameter / $secondParameter;

        $result = $this->subject->runExample($firstParameter, $secondParameter);

        self::assertSame($expectedResult, $result);
    }
}
