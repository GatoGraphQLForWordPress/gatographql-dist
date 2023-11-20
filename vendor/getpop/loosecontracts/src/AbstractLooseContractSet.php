<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\AbstractAutomaticallyInstantiatedService;
use PoP\Root\Services\WithInstanceManagerServiceTrait;
/** @internal */
abstract class AbstractLooseContractSet extends AbstractAutomaticallyInstantiatedService
{
    use WithInstanceManagerServiceTrait;
    /**
     * @var \PoP\LooseContracts\LooseContractManagerInterface|null
     */
    private $looseContractManager;
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
