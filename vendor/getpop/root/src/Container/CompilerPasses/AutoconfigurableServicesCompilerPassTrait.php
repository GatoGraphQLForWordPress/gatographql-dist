<?php

declare (strict_types=1);
namespace PoP\Root\Container\CompilerPasses;

/** @internal */
trait AutoconfigurableServicesCompilerPassTrait
{
    protected function onlyProcessAutoconfiguredServices() : bool
    {
        return \false;
    }
}
