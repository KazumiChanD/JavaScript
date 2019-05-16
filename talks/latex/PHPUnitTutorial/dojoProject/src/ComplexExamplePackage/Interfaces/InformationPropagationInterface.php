<?php
namespace ExampleProject\ComplexExamplePackage\Interfaces;

interface InformationPropagationInterface
{
    /**
     * Returns current score information as string.
     *
     * @return string
     */
    public function getScoreInformation(): string;
}
