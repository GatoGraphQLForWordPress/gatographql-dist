<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\RelationalTypeDataLoaders\UnionType;

use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
use PoPCMSSchema\Tags\TypeResolvers\UnionType\TagUnionTypeResolver;
/** @internal */
class TagUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\UnionType\TagUnionTypeResolver|null
     */
    private $tagUnionTypeResolver;
    protected final function getTagUnionTypeResolver() : TagUnionTypeResolver
    {
        if ($this->tagUnionTypeResolver === null) {
            /** @var TagUnionTypeResolver */
            $tagUnionTypeResolver = $this->instanceManager->getInstance(TagUnionTypeResolver::class);
            $this->tagUnionTypeResolver = $tagUnionTypeResolver;
        }
        return $this->tagUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getTagUnionTypeResolver();
    }
}
