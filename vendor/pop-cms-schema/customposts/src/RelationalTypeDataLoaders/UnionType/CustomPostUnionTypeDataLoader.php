<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\RelationalTypeDataLoaders\UnionType;

use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
/** @internal */
class CustomPostUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?CustomPostUnionTypeResolver $customPostUnionTypeResolver = null;
    protected final function getCustomPostUnionTypeResolver() : CustomPostUnionTypeResolver
    {
        if ($this->customPostUnionTypeResolver === null) {
            /** @var CustomPostUnionTypeResolver */
            $customPostUnionTypeResolver = $this->instanceManager->getInstance(CustomPostUnionTypeResolver::class);
            $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
        }
        return $this->customPostUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCustomPostUnionTypeResolver();
    }
}
