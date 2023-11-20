<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\BasicServiceTrait;
use PoP\Root\Services\AbstractAutomaticallyInstantiatedService;
/** @internal */
abstract class AbstractLooseContractResolutionSet extends AbstractAutomaticallyInstantiatedService
{
    use BasicServiceTrait;
    /**
     * @var \PoP\LooseContracts\LooseContractManagerInterface|null
     */
    private $looseContractManager;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    public final function setLooseContractManager(\PoP\LooseContracts\LooseContractManagerInterface $looseContractManager) : void
    {
        $this->looseContractManager = $looseContractManager;
    }
    protected final function getLooseContractManager() : \PoP\LooseContracts\LooseContractManagerInterface
    {
        if ($this->looseContractManager === null) {
            /** @var LooseContractManagerInterface */
            $looseContractManager = $this->instanceManager->getInstance(\PoP\LooseContracts\LooseContractManagerInterface::class);
            $this->looseContractManager = $looseContractManager;
        }
        return $this->looseContractManager;
    }
    public final function setNameResolver(\PoP\LooseContracts\NameResolverInterface $nameResolver) : void
    {
        $this->nameResolver = $nameResolver;
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
