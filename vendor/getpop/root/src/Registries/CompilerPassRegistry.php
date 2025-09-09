<?php

declare (strict_types=1);
namespace PoP\Root\Registries;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
/** @internal */
class CompilerPassRegistry implements \PoP\Root\Registries\CompilerPassRegistryInterface
{
    /**
     * @var CompilerPassInterface[]
     */
    protected array $compilerPasses = [];
    public function addCompilerPass(CompilerPassInterface $compilerPass) : void
    {
        $this->compilerPasses[] = $compilerPass;
    }
    /**
     * @return CompilerPassInterface[]
     */
    public function getCompilerPasses() : array
    {
        return $this->compilerPasses;
    }
}
