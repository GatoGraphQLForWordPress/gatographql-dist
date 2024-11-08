<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostTagUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\PostTagUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $postTagUpdateMutationErrorPayloadUnionTypeResolver;
    protected final function getPostTagUpdateMutationErrorPayloadUnionTypeResolver() : PostTagUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagUpdateMutationErrorPayloadUnionTypeResolver */
            $postTagUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagUpdateMutationErrorPayloadUnionTypeResolver = $postTagUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostTagUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
