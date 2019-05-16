<?php
namespace ExampleProject\ComplexExamplePackage;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ScoreCounterTest extends TestCase
{
    /** @var ScoreCounter */
    private $subject;

    /** @var MockInterface|WinnableInterface */
    private $mockedWinnable1;

    /** @var MockInterface|WinnableInterface */
    private $mockedWinnable2;

    /** @var (MockInterface|WinableInterface)[] */
    private $mockedWinnables;

    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer1;

    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer2;


    protected function setUp()
    {
        $this->mockedPlayer1   = Mockery::mock(PlayerInterface::class);
        $this->mockedPlayer2   = Mockery::mock(PlayerInterface::class);
        $this->mockedWinnable1 = Mockery::mock(WinnableInterface::class);
        $this->mockedWinnable2 = Mockery::mock(WinnableInterface::class);
        $this->mockedWinnable1->shouldReceive('isWon')
            ->withNoArgs()->andReturn(true);
        $this->mockedWinnable1->shouldReceive('getWinner')
            ->withNoArgs()->andReturn($this->mockedPlayer1);
        $this->mockedWinnable2->shouldReceive('isWon')
            ->withNoArgs()->andReturn(true);
        $this->mockedWinnable2->shouldReceive('getWinner')
            ->withNoArgs()->andReturn($this->mockedPlayer2);

        $this->mockedWinnables = [
            $this->mockedWinnable1,
            $this->mockedWinnable1,
            $this->mockedWinnable1,
            $this->mockedWinnable2,
        ];

        $this->subject = new ScoreCounter();
    }

    public function testGetScore()
    {
        $result = $this->subject->getScore($this->mockedWinnables);

        self::assertSame($result[$this->mockedPlayer1], 3);
        self::assertSame($result[$this->mockedPlayer2], 1);
    }
}
