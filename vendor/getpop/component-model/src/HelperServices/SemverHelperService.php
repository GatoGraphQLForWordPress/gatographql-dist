<?php

declare (strict_types=1);
namespace PoP\ComponentModel\HelperServices;

use GatoExternalPrefixByGatoGraphQL\Composer\Semver\Semver;
use Exception;
/** @internal */
class SemverHelperService implements \PoP\ComponentModel\HelperServices\SemverHelperServiceInterface
{
    /**
     * Determine if given version satisfies given constraints.
     *
     * Use "*" to mean "any version"
     */
    public function satisfies(string $version, string $constraints) : bool
    {
        if ($constraints === '*') {
            return \true;
        }
        /**
         * If passing a wrong value to validate against
         * (eg: "saraza" instead of "1.0.0"),
         * it will throw an Exception
         */
        try {
            return Semver::satisfies($version, $constraints);
        } catch (Exception $exception) {
            return \false;
        }
    }
}
