<?php
namespace Zooroyal\MeetUpExample\Snippets;

// sample(foo)
class Service
{
    function callExternalService($param)
    {
        $externalService = new Service\External();
        $externalService->sendSomething($param);
        return $externalService->getSomething();
    }
}
// end-sample
