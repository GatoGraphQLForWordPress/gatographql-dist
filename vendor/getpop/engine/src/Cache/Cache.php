<?php

declare (strict_types=1);
namespace PoP\Engine\Cache;

use PoP\ComponentModel\Cache\Cache as UpstreamCache;
use GatoExternalPrefixByGatoGraphQL\Psr\Cache\CacheItemInterface;
/** @internal */
class Cache extends UpstreamCache
{
    /**
     * Override to save as deferred, on hook "popcms:shutdown"
     */
    protected function saveCache(CacheItemInterface $cacheItem) : void
    {
        $this->cacheItemPool->saveDeferred($cacheItem);
    }
}
