<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\PostTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostTagUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\PostTagUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostTagUpdateMetaMutationErrorPayloadUnionTypeResolver() : PostTagUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $postTagUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagUpdateMetaMutationErrorPayloadUnionTypeResolver = $postTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostTagUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
