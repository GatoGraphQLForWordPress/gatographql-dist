<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\Cache\Traits;

if (\version_compare(\phpversion('redis'), '6.0.2', '>')) {
    /**
     * @internal
     */
    trait Redis6ProxyTrait
    {
        /**
         * @return \Redis|false|string
         */
        public function dump($key)
        {
            return ($this->lazyObjectState->realInstance = $this->lazyObjectState->realInstance ?? ($this->lazyObjectState->initializer)())->dump(...\func_get_args());
        }
        /**
         * @return \Redis|mixed[]|false
         */
        public function mget($keys)
        {
            return ($this->lazyObjectState->realInstance = $this->lazyObjectState->realInstance ?? ($this->lazyObjectState->initializer)())->mget(...\func_get_args());
        }
        /**
         * @return \Redis|mixed[]|false
         */
        public function waitaof($numlocal, $numreplicas, $timeout)
        {
            return ($this->lazyObjectState->realInstance = $this->lazyObjectState->realInstance ?? ($this->lazyObjectState->initializer)())->waitaof(...\func_get_args());
        }
    }
} else {
    /**
     * @internal
     */
    trait Redis6ProxyTrait
    {
        /**
         * @return \Redis|string
         */
        public function dump($key)
        {
            return ($this->lazyObjectState->realInstance = $this->lazyObjectState->realInstance ?? ($this->lazyObjectState->initializer)())->dump(...\func_get_args());
        }
        /**
         * @return \Redis|mixed[]
         */
        public function mget($keys)
        {
            return ($this->lazyObjectState->realInstance = $this->lazyObjectState->realInstance ?? ($this->lazyObjectState->initializer)())->mget(...\func_get_args());
        }
    }
}
