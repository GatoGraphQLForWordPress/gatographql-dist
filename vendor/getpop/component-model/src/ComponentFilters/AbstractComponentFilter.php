<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentFilters;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractComponentFilter extends AbstractBasicService implements \PoP\ComponentModel\ComponentFilters\ComponentFilterInterface
{
    /**
     * @var \PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface|null
     */
    private $componentProcessorManager;
    protected final function getComponentProcessorManager() : ComponentProcessorManagerInterface
    {
        if ($this->componentProcessorManager === null) {
            /** @var ComponentProcessorManagerInterface */
            $componentProcessorManager = $this->instanceManager->getInstance(ComponentProcessorManagerInterface::class);
            $this->componentProcessorManager = $componentProcessorManager;
        }
        return $this->componentProcessorManager;
    }
    /**
     * @param array<string,mixed> $props
     */
    public function excludeSubcomponent(Component $component, array &$props) : bool
    {
        return \false;
    }
    /**
     * @param Component[] $subcomponents
     * @return Component[]
     */
    public function removeExcludedSubcomponents(Component $component, array $subcomponents) : array
    {
        return $subcomponents;
    }
    /**
     * @param array<string,mixed> $props
     */
    public function prepareForPropagation(Component $component, array &$props) : void
    {
    }
    /**
     * @param array<string,mixed> $props
     */
    public function restoreFromPropagation(Component $component, array &$props) : void
    {
    }
}
