<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategoryUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\PostCategoryUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryUpdateMutationErrorPayloadUnionTypeResolver() : PostCategoryUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryUpdateMutationErrorPayloadUnionTypeResolver */
            $postCategoryUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver = $postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategoryUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
