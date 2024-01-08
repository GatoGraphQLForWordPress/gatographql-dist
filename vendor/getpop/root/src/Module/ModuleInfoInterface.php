<?php

declare (strict_types=1);
namespace PoP\Root\Module;

/** @internal */
interface ModuleInfoInterface
{
    /**
     * @return mixed
     */
    public function get(string $key);
}
