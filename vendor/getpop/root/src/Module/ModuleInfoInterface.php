<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
interface ModuleInfoInterface
{
    public function get(string $key) : mixed;
}
