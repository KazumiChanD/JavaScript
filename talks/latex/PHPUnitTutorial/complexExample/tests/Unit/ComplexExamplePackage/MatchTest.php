<?php
namespace ExampleProject\ComplexExamplePackage;

use DI\Container;
use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\WinnableInterface;
use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as H;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SplObjectStorage;

class MatchTest extends TestCase
{
    /** @var Match */
    private $subject;

    /** @var MockInterface|ScoreCounter */
    private $mockedScoreCounter;

    /** @var MockInterface|Container */
    private $mockedContainer;

    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer;

    /** @var string */
    private $playerName;

    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer1;

    /** @var string */
    private $playerName1;

    protected function setUp()
    {
        $this->playerName   = 'Player';
        $this->mockedPlayer = Mockery::mock(PlayerInterface::class);
        $this->mockedPlayer->shouldReceive('__toString')
            ->withNoArgs()->andReturn($this->playerName);

        $this->playerName1   = 'Player1';
        $this->mockedPlayer1 = Mockery::mock(PlayerInterface::class);
        $this->mockedPlayer1->shouldReceive('__toString')
            ->withNoArgs()->andReturn($this->playerName1);

        $this->mockedContainer    = Mockery::mock(Container::class);
        $this->mockedScoreCounter = Mockery::mock(ScoreCounter::class);

        $this->subject = new Match($this->mockedScoreCounter, $this->mockedContainer);
    }

    public function testGetScoreInformation()
    {
        $expectedSetScoreInformation = 'blablalasdljqiouwd';

        /** @var MockInterface|Set $mockedSet */
        $mockedSet = $this->prepareMockedContainerForMakeSet();
        $mockedSet->shouldReceive('getScoreInformation')
            ->andReturn($expectedSetScoreInformation);

        $this->prepareMatchOutcome(1, 1);


        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::containsString('Current Set : ' . $expectedSetScoreInformation)
        );
    }

    public function testGetWinnerOnWonMatch()
    {
        $this->prepareMockedContainerForMakeSet();
        $this->prepareMatchOutcome(1, 2);

        $result = $this->subject->getWinner();

        self::assertInstanceOf(PlayerInterface::class, $result);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionCode 1521562196
     */
    public function testGetWinnerOpenMatch()
    {
        $this->subject->getWinner();
    }

    public function testIsWonWithFilledSetsDataProvider()
    {
        return [
            'No Win'         => [1, 1, false],
            'No Win either'  => [0, 1, false],
            'PlayerOne Wins' => [2, 0, true],
            'PlayerTwo Wins' => [1, 2, true],
        ];
    }

    /**
     * @dataProvider testIsWonWithFilledSetsDataProvider
     *
     * @param int  $scorePlayerOne
     * @param int  $scorePlayerTwo
     * @param bool $isWon
     *
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testIsWonWithFilledSets(int $scorePlayerOne, int $scorePlayerTwo, bool $isWon)
    {
        $this->prepareMockedContainerForMakeSet();
        $this->prepareMatchOutcome($scorePlayerOne, $scorePlayerTwo);

        $result = $this->subject->isWon();
        self::assertSame($isWon, $result);
    }

    private function prepareMockedContainerForMakeSet() : Set
    {
        $mockedGame = Mockery::mock(Game::class);
        $mockedGame->shouldReceive('isWon')->andReturn(true);

        /** @var MockInterface|Set $mockedSet */
        $mockedSet = Mockery::mock(Set::class);
        $mockedSet->shouldReceive('isWon')->andReturn(true);
        $mockedSet->shouldReceive('addPointToPlayer');


        $this->mockedContainer->shouldReceive('make')
            ->with(Set::class)->andReturn($mockedSet);

        return $mockedSet;
    }

    /**
     * @param int $scorePlayerOne
     * @param int $scorePlayerTwo
     *
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    private function prepareMatchOutcome(int $scorePlayerOne, int $scorePlayerTwo)
    {
        $playerScore = new SplObjectStorage();

        $this->mockedScoreCounter->shouldReceive('getScore')
            ->with(
                H::everyItem(
                    H::anInstanceOf(WinnableInterface::class)
                )
            )->andReturn($playerScore);

        for ($i = 1; $i <= $scorePlayerOne; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer);
            $playerScore->attach($this->mockedPlayer, $i);
        }
        for ($i = 1; $i <= $scorePlayerTwo; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer1);
            $playerScore->attach($this->mockedPlayer1, $i);
        }
    }
}
