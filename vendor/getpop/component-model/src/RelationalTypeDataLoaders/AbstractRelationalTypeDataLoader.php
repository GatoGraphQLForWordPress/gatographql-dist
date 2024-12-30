<?php

declare (strict_types=1);
namespace PoP\ComponentModel\RelationalTypeDataLoaders;

use PoP\Root\Services\AbstractBasicService;
use PoP\LooseContracts\NameResolverInterface;
/** @internal */
abstract class AbstractRelationalTypeDataLoader extends AbstractBasicService implements \PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface
{
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
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
