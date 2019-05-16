<?php
namespace Zooroyal\MeetUpExample\Tests;

use PHPUnit\Framework\TestCase;
use Zooroyal\MeetUpExample\Example;
use Zooroyal\MeetUpExample\FileReader;

class ExampleTestPhpUnit extends TestCase
{
    /** @var array */
    private $expectedResult = ['<?php', 'class Bla', '{', '    private $path;', '}', null];

    private $mockedFileReader;

    private $subject;

    protected function setUp()
    {
        $this->mockedFileReader = $this->createMock(FileReader::class);
        $this->subject = new Example($this->mockedFileReader);
    }

    /**
     * @test
     */
    public function runLineReaderPhpUnitSetUp()
    {
        $this->setUpHeader($this->mockedFileReader);
        $this->mockedFileReader->expects($this->at(3))
            ->method('readLine')->willReturn('    private $path;');
        $this->setUpFooter($this->mockedFileReader);

        $result = $this->subject->runLineReader();

        self::assertEquals($this->expectedResult, $result);
    }

    private function setUpHeader($mockedFileReader)
    {
        $mockedFileReader->expects($this->at(0))
            ->method('readLine')->willReturn('<?php');
        $mockedFileReader->expects($this->at(1))
            ->method('readLine')->willReturn('class Bla');
        $mockedFileReader->expects($this->at(2))
            ->method('readLine')->willReturn('{');
    }

    private function setUpFooter($mockedFileReader)
    {
        $mockedFileReader->expects($this->at(4))
            ->method('readLine')->willReturn('}');
        $mockedFileReader->expects($this->at(5))
            ->method('readLine')->willReturn(null);
    }
}
