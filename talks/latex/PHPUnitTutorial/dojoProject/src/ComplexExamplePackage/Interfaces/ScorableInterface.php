<?php
namespace ExampleProject\ComplexExamplePackage\Interfaces;

interface ScorableInterface
{
    /**
     * This method should be called, when a player scores a point.
     *
     * @param PlayerInterface $player
     *
     * @return void
     */
    public function addPointToPlayer(PlayerInterface $player);
}
