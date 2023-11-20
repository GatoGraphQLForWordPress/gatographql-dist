<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostSetCategoriesMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostSetCategoriesMutationErrorPayloadUnionTypeResolver|null
     */
    private $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    public final function setPostSetCategoriesMutationErrorPayloadUnionTypeResolver(PostSetCategoriesMutationErrorPayloadUnionTypeResolver $postSetCategoriesMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver = $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostSetCategoriesMutationErrorPayloadUnionTypeResolver() : PostSetCategoriesMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postSetCategoriesMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostSetCategoriesMutationErrorPayloadUnionTypeResolver */
            $postSetCategoriesMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostSetCategoriesMutationErrorPayloadUnionTypeResolver::class);
            $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver = $postSetCategoriesMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postSetCategoriesMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostSetCategoriesMutationErrorPayloadUnionTypeResolver();
    }
}
