<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategoryDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    public final function setPostCategoryDeleteMutationErrorPayloadUnionTypeResolver(PostCategoryDeleteMutationErrorPayloadUnionTypeResolver $postCategoryDeleteMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->postCategoryDeleteMutationErrorPayloadUnionTypeResolver = $postCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getPostCategoryDeleteMutationErrorPayloadUnionTypeResolver() : PostCategoryDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryDeleteMutationErrorPayloadUnionTypeResolver */
            $postCategoryDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryDeleteMutationErrorPayloadUnionTypeResolver = $postCategoryDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategoryDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
