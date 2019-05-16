<?php
namespace ExampleProject\ComplexExamplePackage\Interfaces;

interface TennisInterface
{
    public function __construct(ScoreRulesResolverInterface $match);

    /**
     * Returns a string representation of the current state of the game.
     *
     * @return string
     */
    public function getScore() : string;

    /**
     * This method should be called, when a player scores a point.
     *
     * @param PlayerInterface $player
     *
     * @return void
     */
    public function addPointToPlayer(PlayerInterface $player);
}
