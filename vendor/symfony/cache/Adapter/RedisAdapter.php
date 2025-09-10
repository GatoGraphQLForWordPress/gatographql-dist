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

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Marshaller\MarshallerInterface;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Traits\RedisTrait;
/** @internal */
class RedisAdapter extends AbstractAdapter
{
    use RedisTrait;
    public function __construct(\Redis|\RedisArray|\RedisCluster|\GatoExternalPrefixByGatoGraphQL\Predis\ClientInterface|\GatoExternalPrefixByGatoGraphQL\Relay\Relay $redis, string $namespace = '', int $defaultLifetime = 0, ?MarshallerInterface $marshaller = null)
    {
        $this->init($redis, $namespace, $defaultLifetime, $marshaller);
    }
}
