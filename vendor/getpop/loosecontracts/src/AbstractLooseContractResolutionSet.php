<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\AbstractAutomaticallyInstantiatedService;
/** @internal */
abstract class AbstractLooseContractResolutionSet extends AbstractAutomaticallyInstantiatedService
{
    private ?\PoP\LooseContracts\LooseContractManagerInterface $looseContractManager = null;
    private ?\PoP\LooseContracts\NameResolverInterface $nameResolver = null;
    protected final function getLooseContractManager() : \PoP\LooseContracts\LooseContractManagerInterface
    {
        if ($this->looseContractManager === null) {
            /** @var LooseContractManagerInterface */
            $looseContractManager = $this->instanceManager->getInstance(\PoP\LooseContracts\LooseContractManagerInterface::class);
            $this->looseContractManager = $looseContractManager;
        }
        return $this->looseContractManager;
    }
    protected final function getNameResolver() : \PoP\LooseContracts\NameResolverInterface
    {
        if ($this->nameResolver === null) {
            /** @var NameResolverInterface */
            $nameResolver = $this->instanceManager->getInstance(\PoP\LooseContracts\NameResolverInterface::class);
            $this->nameResolver = $nameResolver;
        }
        return $this->nameResolver;
    }
    public final function initialize() : void
    {
        $this->resolveContracts();
    }
    /**
     * Function to execute all code to satisfy the contracts
     */
    protected abstract function resolveContracts() : void;
}
