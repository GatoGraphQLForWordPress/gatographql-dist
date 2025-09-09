<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Attribute;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ContainerInterface;
/** @internal */
#[\Attribute(\Attribute::TARGET_CLASS)]
class AsDecorator
{
    public function __construct(public string $decorates, public int $priority = 0, public int $onInvalid = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE)
    {
    }
}
