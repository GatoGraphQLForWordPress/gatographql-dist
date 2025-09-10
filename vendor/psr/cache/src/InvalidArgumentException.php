<?php

namespace GatoExternalPrefixByGatoGraphQL\Psr\Cache;

/**
 * Exception interface for invalid cache arguments.
 *
 * Any time an invalid argument is passed into a method it must throw an
 * exception class which implements Psr\Cache\InvalidArgumentException.
 * @internal
 */
interface InvalidArgumentException extends CacheException
{
}
