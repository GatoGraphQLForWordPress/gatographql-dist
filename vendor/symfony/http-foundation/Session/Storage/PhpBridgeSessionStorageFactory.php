<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\HttpFoundation\Session\Storage;

use PrefixedByPoP\Symfony\Component\HttpFoundation\Request;
use PrefixedByPoP\Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
// Help opcache.preload discover always-needed symbols
\class_exists(PhpBridgeSessionStorage::class);
/**
 * @author Jérémy Derussé <jeremy@derusse.com>
 * @internal
 */
class PhpBridgeSessionStorageFactory implements SessionStorageFactoryInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy|\SessionHandlerInterface|null
     */
    private $handler;
    /**
     * @var \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag|null
     */
    private $metaBag;
    /**
     * @var bool
     */
    private $secure;
    /**
     * @param \Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy|\SessionHandlerInterface|null $handler
     */
    public function __construct($handler = null, ?MetadataBag $metaBag = null, bool $secure = \false)
    {
        $this->handler = $handler;
        $this->metaBag = $metaBag;
        $this->secure = $secure;
    }
    public function createStorage(?Request $request) : SessionStorageInterface
    {
        $storage = new PhpBridgeSessionStorage($this->handler, $this->metaBag);
        if ($this->secure && (($nullsafeVariable1 = $request) ? $nullsafeVariable1->isSecure() : null)) {
            $storage->setOptions(['cookie_secure' => \true]);
        }
        return $storage;
    }
}
