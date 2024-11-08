<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostTagDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagDeleteMutationErrorPayloadUnionTypeResolver|null
     */
    private $postTagDeleteMutationErrorPayloadUnionTypeResolver;
    protected final function getPostTagDeleteMutationErrorPayloadUnionTypeResolver() : PostTagDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagDeleteMutationErrorPayloadUnionTypeResolver */
            $postTagDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagDeleteMutationErrorPayloadUnionTypeResolver = $postTagDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostTagDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
