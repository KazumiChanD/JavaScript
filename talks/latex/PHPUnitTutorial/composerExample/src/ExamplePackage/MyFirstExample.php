<?php
namespace ExampleProject\ExamplePackage;

class MyFirstExample
{
    /**
     * This function returns the sum of its Parameters
     *
     * @param int $first
     * @param int $second
     *
     * @return int
     */
    public function runExample(int $first, int $second) : int
    {
        return $first / $second;
    }
}
