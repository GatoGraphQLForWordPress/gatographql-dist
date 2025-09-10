<?php

declare (strict_types=1);
namespace PoP\LooseContracts;

use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractNameResolver extends AbstractBasicService implements \PoP\LooseContracts\NameResolverInterface
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
