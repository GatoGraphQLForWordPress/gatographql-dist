<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
interface ModuleConfigurationInterface
{
    public function hasConfigurationValue(string $envVariable) : bool;
    public function getConfigurationValue(string $envVariable) : mixed;
}
