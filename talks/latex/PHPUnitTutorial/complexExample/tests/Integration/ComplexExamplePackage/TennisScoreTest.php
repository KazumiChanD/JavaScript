<?php
namespace ExampleProject\ComplexExamplePackage;

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;

class TennisScoreTest extends TestCase
{
    /** @var Container */
    private $container;

    /** @var Tennis */
    private $subject;

    protected function setUp()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAnnotations(true);
        $this->container = $containerBuilder->build();

        $this->subject = $this->container->get(Tennis::class);
    }

    public function testGetScoreNewGame()
    {
        $result = $this->subject->getScore();
        self::assertInternalType('string', $result);
    }

    public function testGetScoreRunningGame()
    {
        $player1 = new Player('Player1');
        $player2 = new Player('Player2');

        for ($i = 1; $i <= 24; $i++) {
            $this->subject->addPointToPlayer($player1);
            $this->subject->addPointToPlayer($player2);
            $this->subject->addPointToPlayer($player2);
        }

        $result = $this->subject->getScore();
        self::assertInternalType('string', $result);
    }

    public function testGetScoreWonMatch()
    {
        $player1 = new Player('Player1');

        for ($i = 1; $i <= 48; $i++) {
            $this->subject->addPointToPlayer($player1);
        }

        $result = $this->subject->getScore();

        self::assertStringEndsWith('has won the Match!', $result);
    }

    public function testAddPointToPlayer()
    {

    }
}
