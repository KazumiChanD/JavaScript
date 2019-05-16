<?php
namespace Zooroyal\MeetUpExample\Tests;

use Mockery;
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

        $mockedFileReader = Mockery::mock(FileReader::class);
        $mockedFileReader
            ->shouldReceive('setX->setX->setX->setY->readLine')
            ->andReturn($expectation);

        $subject = new Example($mockedFileReader);
        $result = $subject->useFluentInterface();

        self::assertSame($expectation, $result);
    }
    // end-sample
}
