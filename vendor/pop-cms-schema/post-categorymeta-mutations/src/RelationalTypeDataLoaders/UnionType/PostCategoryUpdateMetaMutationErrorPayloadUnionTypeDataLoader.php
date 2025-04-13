<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver() : PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver = $postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
