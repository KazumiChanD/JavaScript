<?php
namespace ExampleProject\ComplexExamplePackage\Interfaces;

interface PlayerInterface
{
    public function __construct(string $name);
    public function __toString() : string;
}
