<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Storage;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Request;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
// Help opcache.preload discover always-needed symbols
\class_exists(NativeSessionStorage::class);
/**
 * @author Jérémy Derussé <jeremy@derusse.com>
 * @internal
 */
class NativeSessionStorageFactory implements SessionStorageFactoryInterface
{
    /**
     * @var mixed[]
     */
    private $options;
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
     * @see NativeSessionStorage constructor.
     * @param \Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy|\SessionHandlerInterface|null $handler
     */
    public function __construct(array $options = [], $handler = null, ?MetadataBag $metaBag = null, bool $secure = \false)
    {
        $this->options = $options;
        $this->handler = $handler;
        $this->metaBag = $metaBag;
        $this->secure = $secure;
    }
    public function createStorage(?Request $request) : SessionStorageInterface
    {
        $storage = new NativeSessionStorage($this->options, $this->handler, $this->metaBag);
        if ($this->secure && (($nullsafeVariable1 = $request) ? $nullsafeVariable1->isSecure() : null)) {
            $storage->setOptions(['cookie_secure' => \true]);
        }
        return $storage;
    }
}
