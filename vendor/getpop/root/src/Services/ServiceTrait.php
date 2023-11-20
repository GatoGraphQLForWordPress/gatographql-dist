<?php

declare (strict_types=1);
namespace PoP\Root\Services;

/**
 * Default implementation for services
 * @internal
 */
trait ServiceTrait
{
    public function isServiceEnabled() : bool
    {
        return \true;
    }
}
