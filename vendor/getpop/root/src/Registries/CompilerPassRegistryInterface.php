<?php

declare (strict_types=1);
namespace PoP\Root\Registries;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
/** @internal */
interface CompilerPassRegistryInterface
{
    public function addCompilerPass(CompilerPassInterface $compilerPass) : void;
    /**
     * @return CompilerPassInterface[]
     */
    public function getCompilerPasses() : array;
}
