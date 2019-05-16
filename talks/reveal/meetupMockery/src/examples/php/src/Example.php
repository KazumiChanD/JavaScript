<?php
namespace Zooroyal\MeetUpExample;

class Example
{
    /** @var FileReader */
    private $fileReader;

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function runLineReader()
    {
        $result = [];
        $line = true;

        while ($line !== null) {
            $result[] = $line = $this->fileReader->readLine();
        }

        return $result;
    }

    public function useFluentInterface()
    {
        return $this->fileReader->setX()
            ->setX()
            ->setX()
            ->setY()
            ->readLine();
    }
}
