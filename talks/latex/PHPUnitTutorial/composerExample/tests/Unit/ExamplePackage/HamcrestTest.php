<?php
namespace Unit\ExamplePackage;

use PHPUnit\Framework\TestCase;
use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as H;

class HamcrestTest extends TestCase
{
    public function testHamcrestValid()
    {
        $string = 'Ich bin ein string!';

        $matcher = H::containsString('bin ein');

        MatcherAssert::assertThat($string, $matcher);
    }

    public function testHamcrestInvalid()
    {
        $string = 'Ich bin ein string!';

        $matcher = H::containsString('bin kein');

        MatcherAssert::assertThat($string, $matcher);
    }

    public function testHamcrestNestedMatcher()
    {
        $string = 'Ich bin ein string!';
        $array = [$string];

        $matcher1 = H::containsString('bin ein');
        $matcher2  = H::hasItemInArray($matcher1);

        MatcherAssert::assertThat($array, $matcher2);
    }
}
