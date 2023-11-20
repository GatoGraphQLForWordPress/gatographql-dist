<?php

declare (strict_types=1);
namespace PoP\ComponentRouting;

use PoP\ComponentModel\Component\Component;
/** @internal */
interface ComponentRoutingProcessorManagerInterface
{
    public function addComponentRoutingProcessor(\PoP\ComponentRouting\ComponentRoutingProcessorInterface $processor) : void;
    /**
     * @return ComponentRoutingProcessorInterface[]
     */
    public function getComponentRoutingProcessors(string $group = null) : array;
    public function getDefaultGroup() : string;
    public function getRoutingComponentByMostAllMatchingStateProperties(string $group = null) : ?Component;
}
