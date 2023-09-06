<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Hooks;

use PoP\ComponentModel\Cache\PersistentCacheInterface;
use PoP\ComponentModel\Cache\TransientCacheInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
abstract class AbstractCacheHookSet extends AbstractHookSet
{
    /**
     * @var \PoP\ComponentModel\Cache\PersistentCacheInterface|null
     */
    private $persistentCache;
    /**
     * @var \PoP\ComponentModel\Cache\TransientCacheInterface|null
     */
    private $transientCache;
    public final function setPersistentCache(PersistentCacheInterface $persistentCache) : void
    {
        $this->persistentCache = $persistentCache;
    }
    protected final function getPersistentCache() : PersistentCacheInterface
    {
        if ($this->persistentCache === null) {
            /** @var PersistentCacheInterface */
            $persistentCache = $this->instanceManager->getInstance(PersistentCacheInterface::class);
            $this->persistentCache = $persistentCache;
        }
        return $this->persistentCache;
    }
    public final function setTransientCache(TransientCacheInterface $transientCache) : void
    {
        $this->transientCache = $transientCache;
    }
    protected final function getTransientCache() : TransientCacheInterface
    {
        if ($this->transientCache === null) {
            /** @var TransientCacheInterface */
            $transientCache = $this->instanceManager->getInstance(TransientCacheInterface::class);
            $this->transientCache = $transientCache;
        }
        return $this->transientCache;
    }
    protected function init() : void
    {
        /**
         * When a plugin/module/component/etc is activated/deactivated,
         * delete the cached files from this application.
         *
         * For instance, for WordPress, these hooks must be provided:
         *
         * - 'activate_plugin'
         * - 'deactivate_plugin'
         */
        foreach ($this->getClearHookNames() as $hookName) {
            App::addAction($hookName, \Closure::fromCallable([$this, 'clear']));
        }
        /**
         * Save all deferred cacheItems.
         *
         * For instance, for WordPress, this hook must be provided:
         *
         * - 'shutdown'
         */
        App::addAction($this->getCommitHookName(), \Closure::fromCallable([$this, 'commit']));
    }
    /**
     * @return string[]
     */
    protected abstract function getClearHookNames() : array;
    protected abstract function getCommitHookName() : string;
    public function clear() : void
    {
        $this->getPersistentCache()->clear();
        $this->getTransientCache()->clear();
    }
    public function commit() : void
    {
        $this->getPersistentCache()->commit();
        $this->getTransientCache()->commit();
    }
}
