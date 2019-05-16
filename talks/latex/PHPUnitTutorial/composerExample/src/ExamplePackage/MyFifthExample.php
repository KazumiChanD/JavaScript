<?php
namespace ExampleProject\ExamplePackage;

use RuntimeException;

class MyFifthExample
{
    /**
     * This function returns something I guess.
     *
     * @param int $first
     *
     * @return int
     */
    public function runExample(int $first) : int
    {
        return strtolower($first);
    }
}
