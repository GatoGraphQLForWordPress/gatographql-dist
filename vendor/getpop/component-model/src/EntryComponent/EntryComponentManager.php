<?php

declare (strict_types=1);
namespace PoP\ComponentModel\EntryComponent;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\EntryComponent\EntryComponentManagerInterface;
use PoP\Root\Services\AbstractBasicService;
use PoP\ComponentRouting\ComponentRoutingGroups;
use PoP\ComponentRouting\ComponentRoutingProcessorManagerInterface;
/** @internal */
class EntryComponentManager extends AbstractBasicService implements EntryComponentManagerInterface
{
    /**
     * @var \PoP\ComponentRouting\ComponentRoutingProcessorManagerInterface|null
     */
    private $routeComponentProcessorManager;
    protected final function getComponentRoutingProcessorManager() : ComponentRoutingProcessorManagerInterface
    {
        if ($this->routeComponentProcessorManager === null) {
            /** @var ComponentRoutingProcessorManagerInterface */
            $routeComponentProcessorManager = $this->instanceManager->getInstance(ComponentRoutingProcessorManagerInterface::class);
            $this->routeComponentProcessorManager = $routeComponentProcessorManager;
        }
        return $this->routeComponentProcessorManager;
    }
    public function getEntryComponent() : ?Component
    {
        return $this->getComponentRoutingProcessorManager()->getRoutingComponentByMostAllMatchingStateProperties(ComponentRoutingGroups::ENTRYCOMPONENT);
    }
}
