<?php
namespace ExampleProject\ComplexExamplePackage;

use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use RuntimeException;
use SplObjectStorage;

class Set implements ScoreRulesResolverInterface
{
    /** @var Game[] */
    private $games = [];

    /** @var Game */
    private $currentGame;

    /** @var PlayerInterface */
    private $playerWon;

    /** @var ScoreCounter */
    private $scoreCounter;

    public function __construct(ScoreCounter $scoreCounter)
    {
        $this->scoreCounter = $scoreCounter;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    public function getScoreInformation() : string
    {
        $setInformation = [];
        /** @var SplObjectStorage $playerScores */
        $playerScores = $this->scoreCounter->getScore($this->games);

        foreach ($playerScores as $player) {
            $setInformation[] = $player . ' : ' . $playerScores[$player];
        }

        $setString  = implode(', ', $setInformation);
        $gameString = 'Current Game : ' . $this->getCurrentGame()->getScoreInformation();

        return $setString . "\n" . $gameString;
    }

    /**
     * @return PlayerInterface
     * @throws RuntimeException
     */
    public function getWinner() : PlayerInterface
    {
        if (!$this->isWon()) {
            throw new RuntimeException('Set is not won yet!', 1521562176);
        }

        return $this->playerWon;
    }

    /**
     * @return Game
     * @throws RuntimeException
     */
    private function getCurrentGame() : Game
    {
        if ($this->isWon()) {
            throw new RuntimeException('Set is already won!', 1521634592);
        }

        if ($this->currentGame === null || $this->currentGame->isWon()) {
            $this->currentGame = new Game();
            $this->games[]     = $this->currentGame;
        }

        return $this->currentGame;
    }

    /**
     * @return bool
     * @throws RuntimeException
     */
    public function isWon() : bool
    {
        if ($this->playerWon !== null) {
            return true;
        }

        if (\count($this->games) < 6) {
            return false;
        }

        $playerScores = $this->scoreCounter->getScore($this->games);

        return $this->determineWinner($playerScores);
    }

    /**
     * @param SplObjectStorage $playerScores
     *
     * @return bool
     */
    private function determineWinner(SplObjectStorage $playerScores) : bool
    {
        $result = false;

        $playerScores->rewind();
        $playerOne      = $playerScores->current();
        $playerOneScore = $playerScores[$playerOne];
        $playerScores->next();
        $playerTwo      = $playerScores->current() ?? null;
        $playerTwoScore = $playerTwo !== null ? $playerScores[$playerTwo] : 0;

        if ($playerOneScore - 1 > $playerTwoScore && $playerOneScore >= 6) {
            $this->playerWon = $playerOne;
            $result          = true;
        } elseif ($playerTwoScore - 1 > $playerOneScore && $playerTwoScore >= 6) {
            $this->playerWon = $playerTwo;
            $result          = true;
        }

        return $result;
    }

    public function addPointToPlayer(PlayerInterface $player)
    {
        if ($this->isWon()) {
            throw new RuntimeException('Match is already won!', 1521684597);
        }

        $this->getCurrentGame()->addPointToPlayer($player);
    }
}
