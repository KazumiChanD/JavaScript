<?php
namespace ExampleProject\ComplexExamplePackage;


use SplObjectStorage;

class ScoreCounter
{
    /**
     * @param WinnableInterface[] $winnables
     *
     * @return SplObjectStorage
     */
    public function getScore(array $winnables) : SplObjectStorage
    {
        $playerScores = new SplObjectStorage();
        foreach ($winnables as $winnable) {
            if ($winnable->isWon()) {
                $player = $winnable->getWinner();
                if (!$playerScores->contains($player)) {
                    $playerScores->attach($player, 0);
                }
                $score = $playerScores[$player];
                $playerScores->attach($player, ++$score);
            }
        }

        return $playerScores;
    }
}
