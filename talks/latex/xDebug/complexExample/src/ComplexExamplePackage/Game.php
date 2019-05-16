<?php
namespace ExampleProject\ComplexExamplePackage;

use BadMethodCallException;
use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use RuntimeException;
use SplObjectStorage;

/**
 * Class Game represents a game of tennis.
 */
class Game implements ScoreRulesResolverInterface
{
    /** @var string */
    private $deuce = 'Deuce';

    /** @var string */
    private $advantage = 'Advantage';

    /** @var SplObjectStorage */
    private $playerScores;

    /** @var PlayerInterface[] */
    private $playerReached40;

    /** @var PlayerInterface */
    private $advancedPlayer;

    /** @var PlayerInterface */
    private $playerWon;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->playerScores = new SplObjectStorage();
    }

    /**
     * Returns current score information as string.
     *
     * @return string
     * @throws BadMethodCallException
     */
    public function getScoreInformation() : string
    {
        if ($this->isWon()) {
            return $this->getWinner() . ' has won the Game!';
        }

        if (\count($this->playerReached40) > 1) {
            if ($this->advancedPlayer === null) {
                return $this->deuce;
            }

            return $this->advancedPlayer . ' : ' . $this->advantage;
        }

        $resultingInformation = [];

        foreach ($this->playerScores as $player) {
            $resultingInformation[] = $player . ' : ' . $this->playerScores[$player];
        }

        return implode(', ', $resultingInformation);
    }

    /**
     * This method should be called, when a player scores a point.
     *
     * @param PlayerInterface $player
     *
     * @throws RuntimeException
     */
    public function addPointToPlayer(PlayerInterface $player)
    {
        if ($this->isWon()) {
            throw new RuntimeException('Game is already won!', 1521561091);
        }

        if (!$this->playerScores->contains($player)) {
            $this->playerScores->attach($player, 0);
        }
        $score = $this->playerScores[$player];

        $newScore = $this->determineNewScore($player, $score);
        $this->playerScores->attach($player, $newScore);
    }

    /**
     * Returns true if game is won.
     *
     * @return bool
     */
    public function isWon() : bool
    {
        return $this->playerWon !== null;
    }

    /**
     * Returns the winner of the game if the game is won. If the game is not won the method throws an exception.
     *
     * @return PlayerInterface
     * @throws BadMethodCallException
     */
    public function getWinner() : PlayerInterface
    {
        if (!$this->isWon()) {
            throw new BadMethodCallException('Game is not won yet!', 1521562175);
        }

        return $this->playerWon;
    }

    /**
     * Determines the new score if player scores a point.
     *
     * @param PlayerInterface $player
     * @param int             $score
     *
     * @return int
     */
    private function determineNewScore(PlayerInterface $player, $score) : int
    {
        $newScore = 0;

        switch ($score) {
            case 0:
                $newScore = 15;
                break;
            case 15:
                $newScore = 30;
                break;
            case 30:
                $newScore                = 40;
                $this->playerReached40[] = $player;
                break;
            case 40:
                $newScore = 40;
                if (\in_array($player, $this->playerReached40, true) && \count($this->playerReached40) === 1) {
                    $this->playerWon = $player;
                }
                if ($this->advancedPlayer === null) {
                    $this->advancedPlayer = $player;
                } elseif ($this->advancedPlayer !== $player) {
                    $this->advancedPlayer = null;
                } else {
                    $this->playerWon = $player;
                }
                break;
        }

        return $newScore;
    }
}
