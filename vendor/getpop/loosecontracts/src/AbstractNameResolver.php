<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\WithInstanceManagerServiceTrait;
abstract class AbstractNameResolver implements \PoP\LooseContracts\NameResolverInterface
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
    public function implementName(string $abstractName, string $implementationName) : void
    {
        $this->getLooseContractManager()->implementNames([$abstractName]);
    }
    /**
     * @param string[] $names
     */
    public function implementNames(array $names) : void
    {
        $this->getLooseContractManager()->implementNames(\array_keys($names));
    }
}
