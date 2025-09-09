<?php

declare (strict_types=1);
namespace PoP\Root\Container;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ContainerBuilder;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Definition;
/** @internal */
final class ContainerBuilderWrapper implements \PoP\Root\Container\ContainerBuilderWrapperInterface
{
    public final function __construct(private readonly ContainerBuilder $containerBuilder)
    {
    }
    public final function getContainerBuilder() : ContainerBuilder
    {
        return $this->containerBuilder;
    }
    public final function getDefinition(string $id) : Definition
    {
        return $this->containerBuilder->getDefinition($id);
    }
    /**
     * @return array<string,Definition> An array of Definition instances
     */
    public final function getDefinitions() : array
    {
        return $this->containerBuilder->getDefinitions();
    }
}
