<?php
namespace ExampleProject\ComplexExamplePackage;

use ExampleProject\ComplexExamplePackage\Interfaces\PlayerInterface;

class Player implements PlayerInterface
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
