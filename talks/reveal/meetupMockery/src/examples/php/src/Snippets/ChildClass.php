<?php
namespace Zooroyal\MeetUpExample\Snippets;

// sample(foo)
class ChildClass extends BigParentClass
{
    public function doesOneThing()
    {
        // but calls on BigParentClass methods
        $result = $this->doesEverything();
        // does something with $result
        return $result;
    }
}
// end-sample
