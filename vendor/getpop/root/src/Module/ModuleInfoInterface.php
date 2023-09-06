<?php

declare (strict_types=1);
namespace PoP\Root\Module;

interface ModuleInfoInterface
{
    /**
     * @return mixed
     */
    public function get(string $key);
}
