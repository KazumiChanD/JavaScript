<?php
namespace Zooroyal\MeetUpExample\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Zooroyal\MeetUpExample\Archivist;

// sample(foo)
class ArchivistTest extends TestCase
{
    public function copyAndStoreSendCopyToStorage()
    {
        $mockedItem = new stdClass();
        $mockedStorage = Mockery::mock(Storage::class);

        $mockedStorage->shouldReceive('add')->with(
            is(
                both(anInstanceOf(Storage::class))
                ->andAlso(not(sameInstance($mockedItem)))
            )
        );

        $subject = new Archivist(Storage::class);
        $subject->copyAndStore($mockedItem);
    }
}
// end-sample
