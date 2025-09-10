<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Traits\Relay;

if (\version_compare(\phpversion('relay'), '0.11.0', '>=')) {
    /**
     * @internal
     */
    trait Relay11Trait
    {
        public function cmsIncrBy($key, $field, $value, ...$fields_and_falues) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsIncrBy(...\func_get_args());
        }
        public function cmsInfo($key) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsInfo(...\func_get_args());
        }
        public function cmsInitByDim($key, $width, $depth) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|bool
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsInitByDim(...\func_get_args());
        }
        public function cmsInitByProb($key, $error, $probability) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|bool
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsInitByProb(...\func_get_args());
        }
        public function cmsMerge($dstkey, $keys, $weights = []) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|bool
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsMerge(...\func_get_args());
        }
        public function cmsQuery($key, ...$fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->cmsQuery(...\func_get_args());
        }
        public function commandlog($subcmd, ...$args) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|bool|int
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->commandlog(...\func_get_args());
        }
        public function hexpire($hash, $ttl, $fields, $mode = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hexpire(...\func_get_args());
        }
        public function hexpireat($hash, $ttl, $fields, $mode = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hexpireat(...\func_get_args());
        }
        public function hexpiretime($hash, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hexpiretime(...\func_get_args());
        }
        public function hgetdel($key, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hgetdel(...\func_get_args());
        }
        public function hgetex($hash, $fields, $expiry = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hgetex(...\func_get_args());
        }
        public function hpersist($hash, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hpersist(...\func_get_args());
        }
        public function hpexpire($hash, $ttl, $fields, $mode = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hpexpire(...\func_get_args());
        }
        public function hpexpireat($hash, $ttl, $fields, $mode = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hpexpireat(...\func_get_args());
        }
        public function hpexpiretime($hash, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hpexpiretime(...\func_get_args());
        }
        public function hpttl($hash, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hpttl(...\func_get_args());
        }
        public function hsetex($key, $fields, $expiry = null) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|false|int
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->hsetex(...\func_get_args());
        }
        public function httl($hash, $fields) : \GatoExternalPrefixByGatoGraphQL\Relay\Relay|array|false
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->httl(...\func_get_args());
        }
        public function serverName() : false|string
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->serverName(...\func_get_args());
        }
        public function serverVersion() : false|string
        {
            return ($this->lazyObjectState->realInstance ??= ($this->lazyObjectState->initializer)())->serverVersion(...\func_get_args());
        }
    }
} else {
    /**
     * @internal
     */
    trait Relay11Trait
    {
    }
}
