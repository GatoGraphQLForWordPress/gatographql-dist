<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Cache;

use DateInterval;
use PoP\ComponentModel\ModelInstance\ModelInstanceInterface;
use PoP\Root\Services\BasicServiceTrait;
use PrefixedByPoP\Psr\Cache\CacheItemInterface;
use PrefixedByPoP\Psr\Cache\CacheItemPoolInterface;
class Cache implements \PoP\ComponentModel\Cache\PersistentCacheInterface, \PoP\ComponentModel\Cache\TransientCacheInterface
{
    /**
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    protected $cacheItemPool;
    use BasicServiceTrait;
    use \PoP\ComponentModel\Cache\ReplaceCurrentExecutionDataWithPlaceholdersTrait;
    /**
     * @var \PoP\ComponentModel\ModelInstance\ModelInstanceInterface|null
     */
    private $modelInstance;
    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }
    public final function setModelInstance(ModelInstanceInterface $modelInstance) : void
    {
        $this->modelInstance = $modelInstance;
    }
    protected final function getModelInstance() : ModelInstanceInterface
    {
        if ($this->modelInstance === null) {
            /** @var ModelInstanceInterface */
            $modelInstance = $this->instanceManager->getInstance(ModelInstanceInterface::class);
            $this->modelInstance = $modelInstance;
        }
        return $this->modelInstance;
    }
    protected function getKey(string $id, string $type) : string
    {
        return $type . '.' . $id;
    }
    protected function getCacheItem(string $id, string $type) : CacheItemInterface
    {
        return $this->cacheItemPool->getItem($this->getKey($id, $type));
    }
    public function hasCache(string $id, string $type) : bool
    {
        $cacheItem = $this->getCacheItem($id, $type);
        return $cacheItem->isHit();
    }
    /**
     * @return boolean True if the item was successfully removed. False if there was an error.
     */
    public function deleteCache(string $id, string $type) : bool
    {
        return $this->cacheItemPool->deleteItem($this->getKey($id, $type));
    }
    public function clear() : void
    {
        $this->cacheItemPool->clear();
    }
    public function commit() : void
    {
        $this->cacheItemPool->commit();
    }
    /**
     * If the item is not cached, it will return `null`
     * @see https://www.php-fig.org/psr/psr-6/
     * @return mixed
     */
    public function getCache(string $id, string $type)
    {
        $cacheItem = $this->getCacheItem($id, $type);
        return $cacheItem->get();
    }
    /**
     * @return mixed
     */
    public function getComponentModelCache(string $id, string $type)
    {
        $content = $this->getCache($id, $type);
        // Inject the current request data in place of the placeholders (pun not intended!)
        return $this->replacePlaceholdersWithCurrentExecutionData($content);
    }
    /**
     * Store the cache
     *
     * @param string $id key under which to store the cache
     * @param string $type the type of the cache, used to distinguish groups of caches
     * @param mixed $content the value to cache
     * @param int|DateInterval|null $time time after which the cache expires, in seconds
     */
    public function storeCache(string $id, string $type, $content, $time = null) : void
    {
        $cacheItem = $this->getCacheItem($id, $type);
        $cacheItem->set($content);
        $cacheItem->expiresAfter($time);
        $this->saveCache($cacheItem);
    }
    /**
     * Store the cache by component model
     * @param int|\DateInterval|null $time
     * @param mixed $content
     */
    public function storeComponentModelCache(string $id, string $type, $content, $time = null) : void
    {
        // Before saving the cache, replace the data specific to this execution with generic placeholders
        $content = $this->replaceCurrentExecutionDataWithPlaceholders($content);
        $this->storeCache($id, $type, $content, $time);
    }
    /**
     * Save immediately. Can override to save as deferred
     */
    protected function saveCache(CacheItemInterface $cacheItem) : void
    {
        $this->cacheItemPool->save($cacheItem);
    }
    /**
     * @return mixed
     */
    public function getCacheByModelInstance(string $type)
    {
        return $this->getComponentModelCache($this->getModelInstance()->getModelInstanceID(), $type);
    }
    /**
     * @param mixed $content
     */
    public function storeCacheByModelInstance(string $type, $content) : void
    {
        $this->storeCache($this->getModelInstance()->getModelInstanceID(), $type, $content);
    }
}
