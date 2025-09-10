<?php

declare (strict_types=1);
namespace GatoExternalPrefixByGatoGraphQL\GuzzleHttp\Promise;

/**
 * Interface used with classes that return a promise.
 * @internal
 */
interface PromisorInterface
{
    /**
     * Returns a promise.
     */
    public function promise() : PromiseInterface;
}
