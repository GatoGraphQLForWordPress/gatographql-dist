<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Traits;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\PruneableInterface;
use GatoExternalPrefixByGatoGraphQL\Symfony\Contracts\Service\ResetInterface;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
trait ProxyTrait
{
    /**
     * @var object
     */
    private $pool;
    public function prune() : bool
    {
        return $this->pool instanceof PruneableInterface && $this->pool->prune();
    }
    public function reset() : void
    {
        if ($this->pool instanceof ResetInterface) {
            $this->pool->reset();
        }
    }
}
