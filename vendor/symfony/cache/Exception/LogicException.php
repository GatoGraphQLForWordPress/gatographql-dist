<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\Cache\Exception;

use PrefixedByPoP\Psr\Cache\CacheException as Psr6CacheInterface;
use PrefixedByPoP\Psr\SimpleCache\CacheException as SimpleCacheInterface;
if (\interface_exists(SimpleCacheInterface::class)) {
    /** @internal */
    class LogicException extends \LogicException implements Psr6CacheInterface, SimpleCacheInterface
    {
    }
} else {
    /** @internal */
    class LogicException extends \LogicException implements Psr6CacheInterface
    {
    }
}
