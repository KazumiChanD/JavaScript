<?php
namespace ExampleProject\Tests\Unit\ExamplePackage;

use ExampleProject\ExamplePackage\MyFourthExample;
use PHPUnit\Framework\TestCase;

class MyFourthExampleTest extends TestCase
{
    public function testRunExample()
    {
        $this->expectOutputString(MyFourthExample::MEINE_AUSGABE);

        $subject = new MyFourthExample();

        $subject->runExample();
    }
}
