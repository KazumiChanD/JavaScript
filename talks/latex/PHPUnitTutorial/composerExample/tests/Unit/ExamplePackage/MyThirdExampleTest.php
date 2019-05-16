<?php
namespace ExampleProject\Tests\Unit\ExamplePackage;

use ExampleProject\ExamplePackage\MyThirdExample;
use PHPUnit\Framework\TestCase;

class MyThirdExampleTest extends TestCase
{
    public function runTestSumsUpParametersDataProvider()
    {
        return [
            'division by one'             => [4, 1, 4],
            'division with negativ value' => [5, -5, -1],
        ];
    }

    /**
     * @test
     * @dataProvider runTestSumsUpParametersDataProvider
     *
     * @param int $firstParameter
     * @param int $secondParameter
     * @param int $expectedResult
     */
    public function runExampleDividesParameters(int $firstParameter, int $secondParameter, int $expectedResult)
    {
        $subject = new MyThirdExample();

        $result = $subject->runExample($firstParameter, $secondParameter);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionCode 1520867252
     * @expectedExceptionMessage Division by zero not allowed.
     */
    public function runExampleShouldthrowExceptionOnDevisionByZero()
    {
        $subject = new MyThirdExample();

        $subject->runExample(3, 0);
    }
}
