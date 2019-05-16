<?php
namespace ExampleProject\ComplexExamplePackage;

use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as H;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class MyComplexExampleTest extends TestCase
{
    /** @var Tennis */
    private $subject;

    /** @var MockInterface|Match */
    private $match;

    protected function setUp()
    {
        $this->match = Mockery::mock(Match::class);

        $this->subject = new Tennis(
            $this->match
        );
    }

    public function testGetScoreReturnsString()
    {
        $expectedScoreString = 'blablablablabl';
        $this->match->shouldReceive('getScoreInformation')->andReturn($expectedScoreString);

        $result = $this->subject->getScore();

        MatcherAssert::assertThat($result, H::stringValue());
    }
}
