<?php

declare (strict_types=1);
namespace PoP\Root\Services;

/**
 * Container services
 * @internal
 */
interface ActivableServiceInterface
{
    public function isServiceEnabled() : bool;
}