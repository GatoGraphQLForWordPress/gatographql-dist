<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\AbstractAutomaticallyInstantiatedService;
/** @internal */
abstract class AbstractLooseContractSet extends AbstractAutomaticallyInstantiatedService
{
    private ?\PoP\LooseContracts\LooseContractManagerInterface $looseContractManager = null;
    protected final function getLooseContractManager() : \PoP\LooseContracts\LooseContractManagerInterface
    {
        if ($this->looseContractManager === null) {
            /** @var LooseContractManagerInterface */
            $looseContractManager = $this->instanceManager->getInstance(\PoP\LooseContracts\LooseContractManagerInterface::class);
            $this->looseContractManager = $looseContractManager;
        }
        return $this->looseContractManager;
    }
    public function initialize() : void
    {
        $this->getLooseContractManager()->requireNames($this->getRequiredNames());
    }
    /**
     * @return string[]
     */
    public function getRequiredNames() : array
    {
        return [];
    }
}
