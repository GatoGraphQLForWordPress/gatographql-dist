<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategorySetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostCategorySetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\PostCategorySetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postCategorySetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostCategorySetMetaMutationErrorPayloadUnionTypeResolver() : PostCategorySetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postCategorySetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostCategorySetMetaMutationErrorPayloadUnionTypeResolver */
            $postCategorySetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostCategorySetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postCategorySetMetaMutationErrorPayloadUnionTypeResolver = $postCategorySetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postCategorySetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostCategorySetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
