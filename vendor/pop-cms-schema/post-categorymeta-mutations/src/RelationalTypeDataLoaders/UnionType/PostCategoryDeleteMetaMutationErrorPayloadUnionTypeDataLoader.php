<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategoryDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver() : PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver = $postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategoryDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
