<?php
namespace ExampleProject\ComplexExamplePackage;

use DI\Annotation\Inject;
use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\ScoreRulesResolverInterface;
use ExampleProject\ComplexExamplePackage\Interfaces\TennisInterface;

class Tennis implements TennisInterface
{
    /** @var Match */
    private $match;

    /**
     * TennisScore constructor.
     * @Inject({"ExampleProject\ComplexExamplePackage\Match"})
     *
     * @param ScoreRulesResolverInterface $match
     */
    public function __construct(ScoreRulesResolverInterface $match)
    {
        $this->match = $match;
    }

    public function getScore() : string
    {
        return 'Match : ' . $this->match->getScoreInformation();
    }

    public function addPointToPlayer(PlayerInterface $player)
    {
        $this->match->addPointToPlayer($player);
    }
}
