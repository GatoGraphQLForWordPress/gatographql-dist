<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Storage\Handler;

/**
 * Memcached based session storage handler based on the Memcached class
 * provided by the PHP memcached extension.
 *
 * @see https://php.net/memcached
 *
 * @author Drak <drak@zikula.org>
 * @internal
 */
class MemcachedSessionHandler extends AbstractSessionHandler
{
    /**
     * @var \Memcached
     */
    private $memcached;
    /**
     * Time to live in seconds.
     * @var int|\Closure|null
     */
    private $ttl;
    /**
     * Key prefix for shared environments.
     * @var string
     */
    private $prefix;
    /**
     * Constructor.
     *
     * List of available options:
     *  * prefix: The prefix to use for the memcached keys in order to avoid collision
     *  * ttl: The time to live in seconds.
     *
     * @throws \InvalidArgumentException When unsupported options are passed
     */
    public function __construct(\Memcached $memcached, array $options = [])
    {
        $this->memcached = $memcached;
        if ($diff = \array_diff(\array_keys($options), ['prefix', 'expiretime', 'ttl'])) {
            throw new \InvalidArgumentException(\sprintf('The following options are not supported "%s".', \implode(', ', $diff)));
        }
        $this->ttl = $options['expiretime'] ?? $options['ttl'] ?? null;
        $this->prefix = $options['prefix'] ?? 'sf2s';
    }
    public function close() : bool
    {
        return $this->memcached->quit();
    }
    protected function doRead(string $sessionId) : string
    {
        return $this->memcached->get($this->prefix . $sessionId) ?: '';
    }
    public function updateTimestamp(string $sessionId, string $data) : bool
    {
        $this->memcached->touch($this->prefix . $sessionId, $this->getCompatibleTtl());
        return \true;
    }
    protected function doWrite(string $sessionId, string $data) : bool
    {
        return $this->memcached->set($this->prefix . $sessionId, $data, $this->getCompatibleTtl());
    }
    private function getCompatibleTtl() : int
    {
        $ttl = ($this->ttl instanceof \Closure ? ($this->ttl)() : $this->ttl) ?? \ini_get('session.gc_maxlifetime');
        // If the relative TTL that is used exceeds 30 days, memcached will treat the value as Unix time.
        // We have to convert it to an absolute Unix time at this point, to make sure the TTL is correct.
        if ($ttl > 60 * 60 * 24 * 30) {
            $ttl += \time();
        }
        return $ttl;
    }
    protected function doDestroy(string $sessionId) : bool
    {
        $result = $this->memcached->delete($this->prefix . $sessionId);
        return $result || \Memcached::RES_NOTFOUND == $this->memcached->getResultCode();
    }
    /**
     * @return int|false
     */
    public function gc(int $maxlifetime)
    {
        // not required here because memcached will auto expire the records anyhow.
        return 0;
    }
    /**
     * Return a Memcached instance.
     */
    protected function getMemcached() : \Memcached
    {
        return $this->memcached;
    }
}
