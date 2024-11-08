<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Exception;

use GatoExternalPrefixByGatoGraphQL\Psr\Cache\CacheException as Psr6CacheInterface;
use GatoExternalPrefixByGatoGraphQL\Psr\SimpleCache\CacheException as SimpleCacheInterface;
if (\interface_exists(SimpleCacheInterface::class)) {
    /** @internal */
    class CacheException extends \Exception implements Psr6CacheInterface, SimpleCacheInterface
    {
    }
} else {
    /** @internal */
    class CacheException extends \Exception implements Psr6CacheInterface
    {
    }
}
