<?php
namespace ExampleProject\ExamplePackage;

class MyFourthExample
{
    const MEINE_AUSGABE = 'Meine Ausgabe';

    /**
     * This function writes a string to stdout.
     */
    public function runExample()
    {
        echo self::MEINE_AUSGABE;
    }
}
