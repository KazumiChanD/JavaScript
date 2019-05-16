<?php
namespace ExampleProject\ComplexExamplePackage\Interfaces;

interface WinnableInterface
{
    public function getWinner(): PlayerInterface;
    public function isWon() : bool;
}
