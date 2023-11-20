<?php

declare (strict_types=1);
namespace PoP\Root\Container;

use PrefixedByPoP\Symfony\Component\DependencyInjection\ContainerBuilder;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Definition;
/** @internal */
interface ContainerBuilderWrapperInterface
{
    public function getContainerBuilder() : ContainerBuilder;
    public function getDefinition(string $id) : Definition;
    /**
     * @return Definition[] An array of Definition instances
     */
    public function getDefinitions() : array;
}
