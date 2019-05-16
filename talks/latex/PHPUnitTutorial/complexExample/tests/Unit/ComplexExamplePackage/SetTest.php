<?php
namespace ExampleProject\ComplexExamplePackage;

use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\WinnableInterface;
use Hamcrest\FeatureMatcher;
use Hamcrest\Matcher;
use Hamcrest\MatcherAssert;
use Hamcrest\Matchers as H;
use Hamcrest\TypeSafeMatcher;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SplObjectStorage;

class SetTest extends TestCase
{
    /** @var Set */
    private $subject;
    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer;
    /** @var string */
    private $playerName;
    /** @var MockInterface|PlayerInterface */
    private $mockedPlayer1;
    /** @var string */
    private $playerName1;
    /** @var MockInterface|ScoreCounter */
    private $mockedScoreCounter;

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

        $this->mockedScoreCounter = Mockery::mock(ScoreCounter::class);

        $this->subject = new Set($this->mockedScoreCounter);
    }

    public function testIsWon()
    {
        $this->prepareWonSet();

        $result = $this->subject->isWon();

        self::assertTrue($result);
    }

    public function testGetWinner()
    {
        $this->prepareWonSet();

        $result = $this->subject->getWinner();
        self::assertSame($this->mockedPlayer, $result);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionCode 1521562176
     */
    public function testGetWinnerThrowsExceptionIfGameNotWon()
    {
        $this->subject->getWinner();
    }

    public function testGetScoreInformation()
    {
        $expectedPlayerScore = new SplObjectStorage();
        $expectedPlayerScore->attach($this->mockedPlayer, 1);
        $expectedPlayerScore->attach($this->mockedPlayer1, 1);

        for ($i = 1; $i <= 4; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer);
        }
        for ($i = 1; $i <= 4; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer1);
        }

        $this->mockedScoreCounter->shouldReceive('getScore')
            ->with(
                H::everyItem(
                    H::anInstanceOf(WinnableInterface::class)
                )
            )->andReturn($expectedPlayerScore);

        $result = $this->subject->getScoreInformation();

        MatcherAssert::assertThat(
            $result,
            H::allOf(
                H::containsString(
                    $this->playerName . ' : 1, '
                    . $this->playerName1 . ' : 1'
                ),
                H::containsString(
                    'Current Game : '
                )
            )
        );
    }

    private function prepareWonSet()
    {
        $expectedPlayerScoreNotWon = new SplObjectStorage();
        $expectedPlayerScoreNotWon->attach($this->mockedPlayer, 5);
        $expectedPlayerScore = new SplObjectStorage();
        $expectedPlayerScore->attach($this->mockedPlayer, 6);

        $this->mockedScoreCounter->shouldReceive('getScore')
            ->with(
                H::allOf(
                    H::everyItem(
                        H::anInstanceOf(WinnableInterface::class)
                    ),
                    H::anyOf(
                        H::arrayWithSize(H::atMost(5)),
                        H::hasItem($this->isWon(H::equalTo(false)))
                    )
                )
            )->andReturn($expectedPlayerScoreNotWon);

        $this->mockedScoreCounter->shouldReceive('getScore')
            ->with(
                H::allOf(
                    H::everyItem(
                        H::anInstanceOf(WinnableInterface::class)
                    ),
                    H::arrayWithSize(6),
                    H::hasItem($this->isWon(H::equalTo(true)))
                )
            )->andReturn($expectedPlayerScore);


        for ($i = 1; $i <= 24; $i++) {
            $this->subject->addPointToPlayer($this->mockedPlayer);
        }
    }

    private function isWon(Matcher $matcher)
    {
        return new class(
            TypeSafeMatcher::TYPE_OBJECT,
            ScoreRulesResolverInterface::class,
            $matcher,
            'isWon',
            'yes it\'s won'
        ) extends FeatureMatcher
        {
            /**
             * Implement this to extract the interesting feature.
             *
             * @param mixed $actual the target object
             *
             * @return mixed the feature to be matched
             */
            protected function featureValueOf($actual)
            {
                return $actual->isWon();
            }
        };
    }
}
