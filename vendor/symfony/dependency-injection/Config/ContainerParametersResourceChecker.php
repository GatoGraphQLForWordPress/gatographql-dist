<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\DependencyInjection\Config;

use PrefixedByPoP\Symfony\Component\Config\Resource\ResourceInterface;
use PrefixedByPoP\Symfony\Component\Config\ResourceCheckerInterface;
use PrefixedByPoP\Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 * @internal
 */
class ContainerParametersResourceChecker implements ResourceCheckerInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function supports(ResourceInterface $metadata) : bool
    {
        return $metadata instanceof ContainerParametersResource;
    }
    public function isFresh(ResourceInterface $resource, int $timestamp) : bool
    {
        foreach ($resource->getParameters() as $key => $value) {
            if (!$this->container->hasParameter($key) || $this->container->getParameter($key) !== $value) {
                return \false;
            }
        }
        return \true;
    }
}
