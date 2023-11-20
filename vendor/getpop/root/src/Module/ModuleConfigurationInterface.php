<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
interface ModuleConfigurationInterface
{
    public function hasConfigurationValue(string $envVariable) : bool;
    /**
     * @return mixed
     */
    public function getConfigurationValue(string $envVariable);
}
