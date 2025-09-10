<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\Root\Exception\ShouldNotHappenException;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
class ComponentProcessorManager extends AbstractBasicService implements \PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface
{
    /**
     * @var array<string,array<string,ComponentProcessorInterface>>
     */
    private array $componentProcessors = [];
    /**
     * Return the ComponentProcessor that handles the Component
     *
     * @throws ShouldNotHappenException
     */
    public function getComponentProcessor(Component $component) : \PoP\ComponentModel\ComponentProcessors\ComponentProcessorInterface
    {
        if (!isset($this->componentProcessors[$component->processorClass][$component->name])) {
            /** @var ComponentProcessorInterface */
            $componentProcessor = $this->getInstanceManager()->getInstance($component->processorClass);
            if (!\in_array($component->name, $componentProcessor->getComponentNamesToProcess())) {
                throw new ShouldNotHappenException(\sprintf('Component Processor of class \'%s\' does not handle component with name \'%s\'', $component->processorClass, $component->name));
            }
            $this->componentProcessors[$component->processorClass][$component->name] = $componentProcessor;
        }
        return $this->componentProcessors[$component->processorClass][$component->name];
    }
}
