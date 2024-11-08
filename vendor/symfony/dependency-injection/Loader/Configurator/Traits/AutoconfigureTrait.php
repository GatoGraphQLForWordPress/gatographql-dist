<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
/** @internal */
trait AutoconfigureTrait
{
    /**
     * Sets whether or not instanceof conditionals should be prepended with a global set.
     *
     * @return $this
     *
     * @throws InvalidArgumentException when a parent is already set
     */
    public final function autoconfigure(bool $autoconfigured = \true)
    {
        $this->definition->setAutoconfigured($autoconfigured);
        return $this;
    }
}
