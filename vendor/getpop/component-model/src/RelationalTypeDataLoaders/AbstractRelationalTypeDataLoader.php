<?php

declare (strict_types=1);
namespace PoP\ComponentModel\RelationalTypeDataLoaders;

use PoP\Root\Services\BasicServiceTrait;
use PoP\LooseContracts\NameResolverInterface;
abstract class AbstractRelationalTypeDataLoader implements \PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface
{
    use BasicServiceTrait;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    public final function setNameResolver(NameResolverInterface $nameResolver) : void
    {
        $this->nameResolver = $nameResolver;
    }
    protected final function getNameResolver() : NameResolverInterface
    {
        if ($this->nameResolver === null) {
            /** @var NameResolverInterface */
            $nameResolver = $this->instanceManager->getInstance(NameResolverInterface::class);
            $this->nameResolver = $nameResolver;
        }
        return $this->nameResolver;
    }
}
