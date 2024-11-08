<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetCategoriesOnPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver() : RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver */
            $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver = $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver();
    }
}
