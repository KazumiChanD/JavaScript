<?php
namespace ExampleProject\ComplexExamplePackage;

use DI\Container;
use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use RuntimeException;
use SplObjectStorage;

class Match implements ScoreRulesResolverInterface
{
    /** @var Set[] */
    private $sets = [];

    /** @var Set */
    private $currentSet;

    /** @var PlayerInterface */
    private $playerWon;

    /** @var ScoreCounter */
    private $scoreCounter;

    /** @var Container */
    private $container;

    public function __construct(ScoreCounter $scoreCounter, Container $container)
    {
        $this->scoreCounter = $scoreCounter;
        $this->container    = $container;
    }

    /**
     * {@inheritdoc}
     * @throws \RuntimeException
     */
    public function getScoreInformation() : string
    {
        if ($this->isWon()) {
            return $this->getWinner() . ' has won the Match!';
        }

        $matchInformation = [];
        /** @var SplObjectStorage $playerScores */
        $playerScores = $this->scoreCounter->getScore($this->sets);

        foreach ($playerScores as $player) {
            $matchInformation[] = $player . ' : ' . $playerScores[$player];
        }

        $matchString = implode(', ', $matchInformation);
        $setString   = 'Current Set : ' . $this->getCurrentSet()->getScoreInformation();

        return $matchString . "\n" . $setString;
    }

    /**
     * @return PlayerInterface
     * @throws RuntimeException
     */
    public function getWinner() : PlayerInterface
    {
        if (!$this->isWon()) {
            throw new RuntimeException('Match is not won yet!', 1521562196);
        }

        return $this->playerWon;
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

        if (\count($this->sets) < 2) {
            return false;
        }

        $playerScores = $this->scoreCounter->getScore($this->sets);

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

        if ($playerOneScore > $playerTwoScore && $playerOneScore + $playerTwoScore >= 2) {
            $this->playerWon = $playerOne;
            $result          = true;
        } elseif ($playerOneScore < $playerTwoScore && $playerOneScore + $playerTwoScore >= 2) {
            $this->playerWon = $playerTwo;
            $result          = true;
        }

        return $result;
    }

    private function getCurrentSet()
    {
        if ($this->currentSet === null || $this->currentSet->isWon()) {
            $this->currentSet = $this->container->make(Set::class);
            $this->sets[]     = $this->currentSet;
        }

        return $this->currentSet;
    }

    public function addPointToPlayer(PlayerInterface $player)
    {
        if ($this->isWon()) {
            throw new RuntimeException('Match is already won!', 1521637597);
        }

        $this->getCurrentSet()->addPointToPlayer($player);
    }
}
