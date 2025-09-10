<?php

declare (strict_types=1);
namespace PoP\Root\Container;

/** @internal */
class SystemContainerBuilderFactory
{
    use \PoP\Root\Container\ContainerBuilderFactoryTrait;
    public function getContainerClassName() : string
    {
        return 'SystemServiceContainer';
    }
}
