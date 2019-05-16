<?php
namespace ExampleProject\ComplexExamplePackage;

use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as H;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /** @var Game */
    private $subject;
    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer;
    /** @var string */
    private $playerName = 'Player';
    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer1;
    /** @var string */
    private $playerName1 = 'Player1';

    protected function setUp()
    {
        $this->mockedPlayer = Mockery::mock(PlayerInterface::class);
        $this->mockedPlayer->shouldReceive('__toString')
            ->withNoArgs()->andReturn($this->playerName);

        $this->mockedPlayer1 = Mockery::mock(PlayerInterface::class);
        $this->mockedPlayer1->shouldReceive('__toString')
            ->withNoArgs()->andReturn($this->playerName1);

        $this->subject = new Game();
    }

    public function testSubjectImplementsScoreRulesResolverInterface()
    {
        self::assertInstanceOf(ScoreRulesResolverInterface::class, $this->subject);
    }

    public function testAddPointToPlayer()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
    }

    public function testGetScoreInformationDataProvider()
    {
        return [
            '15' => [1, ' : 15'],
            '30' => [2, ' : 30'],
            '40' => [3, ' : 40'],
        ];
    }

    /**
     * @dataProvider testGetScoreInformationDataProvider
     *
     * @param $scoreCount
     * @param $expectedString
     */
    public function testGetScoreInformation($scoreCount, $expectedString)
    {
        for ($i = 1; $i <= $scoreCount; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer);
        }

        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::containsString($this->playerName . $expectedString)
        );
    }

    public function testGetScoreInformationDeuce()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer1);

        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::containsString('Deuce')
        );
    }

    public function testGetScoreInformationAdvantage()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer);

        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::containsString($this->playerName . ' : Advantage')
        );
    }

    public function testGetScoreInformationWonFromAdvantage()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer1);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);

        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::containsString($this->playerName . ' has won the Game!')
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionCode 1521561091
     */
    public function testGetScoreInformationThrowsException()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
    }

    public function testisWonFalse()
    {
        $result = $this->subject->isWon();
        self::assertFalse($result);
    }

    public function testisWonTrue()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);

        $result = $this->subject->isWon();
        self::assertTrue($result);
    }

    public function testGetWinner()
    {
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);
        $this->subject->addPointToPlayer($this->mockedPlayer);

        $result = $this->subject->getWinner();
        self::assertSame($this->mockedPlayer, $result);
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionCode 1521562175
     */
    public function testGetWinnerThrowsExceptionIfGameNotWon()
    {
        $this->subject->getWinner();
    }
}
