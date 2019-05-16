<?php
namespace Zooroyal\MeetUpExample;

// sample(foo)
class Archivist
{
    /** @var Storage */
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function copyAndStore($object)
    {
        $copy = $this->copyObject($object);
        $this->storage->add($copy);
    }
    // ...
}
// end-sample
