<?php
namespace Zooroyal\MeetUpExample\Tests\Snippets;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Zooroyal\MeetUpExample\Snippets\Service;

class ServiceTest extends TestCase
{
    /**
     * @runTestsInSeparateProcesses
     * @preserveGlobalState disabled
     */
    public function testCallingExternalService()
    {
        $param = 'Testing';

        $externalMock = m::mock('overload:' . External::class);
        $externalMock->shouldReceive('sendSomething')->once()
            ->with($param);
        $externalMock->shouldReceive('getSomething')->once()
            ->andReturn('Tested!');

        $service = new Service();

        $result = $service->callExternalService($param);

        $this->assertSame('Tested!', $result);
    }
}
