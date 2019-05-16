<?php
namespace Zooroyal\MeetUpExample\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Zooroyal\MeetUpExample\Example;
use Zooroyal\MeetUpExample\FileReader;

class ExampleTest extends TestCase
{
    /** @var array */
    private $expectedResult = [
        '<?php', 'class Bla', '{', '    private $path;', '}', null,
    ];

    /**
     * @test
     */
    private $mockedFileReader;

    private $subject;

    protected function setUp()
    {
        $this->mockedFileReader = Mockery::mock(FileReader::class);
        $this->subject = new Example($this->mockedFileReader);
    }

    public function runLineReaderMockerySetUp()
    {
        $this->setUpHeader($this->mockedFileReader);
        $this->mockedFileReader->shouldReceive('readLine')->once()
            ->andReturn('    private $path;');
        $this->setUpFooter($this->mockedFileReader);

        $result = $this->subject->runLineReader();

        self::assertEquals($this->expectedResult, $result);
    }

    private function setUpHeader($mockedFileReader)
    {
        $mockedFileReader->shouldReceive('readLine')->times(3)
            ->andReturn('<?php', 'class Bla', '{')->ordered();
    }

    private function setUpFooter($mockedFileReader)
    {
        $mockedFileReader->shouldReceive('readLine')->twice()
            ->andReturn('}', null);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
