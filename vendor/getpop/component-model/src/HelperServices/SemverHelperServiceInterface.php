<?php

declare (strict_types=1);
namespace PoP\ComponentModel\HelperServices;

/** @internal */
interface SemverHelperServiceInterface
{
    /**
     * Determine if given version satisfies given constraints.
     */
    public function satisfies(string $version, string $constraints) : bool;
}
