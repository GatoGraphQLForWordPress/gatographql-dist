<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Extension;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ContainerBuilder;
/** @internal */
interface PrependExtensionInterface
{
    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @return void
     */
    public function prepend(ContainerBuilder $container);
}
