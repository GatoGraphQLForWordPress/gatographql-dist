<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver(RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver() : RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetCategoriesOnCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
