<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\DependencyInjection\Attribute;

/**
 * An attribute to tell the class should not be registered as service.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 * @internal
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class Exclude
{
}
