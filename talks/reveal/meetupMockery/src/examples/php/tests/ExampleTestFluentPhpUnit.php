<?php
namespace Zooroyal\MeetUpExample\Tests;

use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as M;
use PHPUnit\Framework\TestCase;
use Zooroyal\MeetUpExample\Example;
use Zooroyal\MeetUpExample\FileReader;

class ExampleTestFluent extends TestCase
{
    /**
     * @test
     */
    // sample(foo)
    public function useFluentInterface()
    {
        $expectation = 'blub';

        $mockedFileReader = $this->createMock(FileReader::class);
        $mockedFileReader->expects($this->exactly(3))
            ->method('setX')->willReturnSelf();
        $mockedFileReader->expects($this->once())
            ->method('setY')->willReturnSelf();
        $mockedFileReader->expects($this->once())
            ->method('readLine')->willReturn($expectation);

        $subject = new Example($mockedFileReader);
        $result = $subject->useFluentInterface();

        self::assertSame($expectation, $result);
    }
    // end-sample
}
