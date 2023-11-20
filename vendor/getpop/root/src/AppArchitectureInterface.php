<?php

declare (strict_types=1);
namespace PoP\Root;

/** @internal */
interface AppArchitectureInterface
{
    public static function isDowngraded() : bool;
}
