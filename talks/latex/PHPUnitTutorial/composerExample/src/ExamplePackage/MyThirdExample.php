<?php
namespace ExampleProject\ExamplePackage;

use RuntimeException;

class MyThirdExample
{
    /**
     * This function returns the sum of its Parameters
     *
     * @param int $first
     * @param int $second
     *
     * @return int
     * @throws RuntimeException
     */
    public function runExample(int $first, int $second) : int
    {
        if ($second === 0) {
            throw new RuntimeException('Division by zero not allowed.', 1520867252);
        }

        return $first / $second;
    }
}
