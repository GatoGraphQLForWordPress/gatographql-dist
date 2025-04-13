<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategoryAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategoryAddMetaMutationErrorPayloadUnionTypeResolver() : PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver */
            $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategoryAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver = $postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategoryAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategoryAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
