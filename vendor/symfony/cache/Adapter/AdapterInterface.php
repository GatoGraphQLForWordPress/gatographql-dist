<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Adapter;

use GatoExternalPrefixByGatoGraphQL\Psr\Cache\CacheItemPoolInterface;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\CacheItem;
// Help opcache.preload discover always-needed symbols
\class_exists(CacheItem::class);
/**
 * Interface for adapters managing instances of Symfony's CacheItem.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @internal
 */
interface AdapterInterface extends CacheItemPoolInterface
{
    /**
     * @param mixed $key
     */
    public function getItem($key) : \GatoExternalPrefixByGatoGraphQL\Psr\Cache\CacheItemInterface;
    /**
     * @return iterable<string, CacheItem>
     */
    public function getItems(array $keys = []) : iterable;
    public function clear(string $prefix = '') : bool;
}
