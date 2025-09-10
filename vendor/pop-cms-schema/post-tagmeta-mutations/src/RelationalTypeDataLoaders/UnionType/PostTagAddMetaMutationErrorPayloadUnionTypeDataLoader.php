<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\PostTagAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostTagAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?PostTagAddMetaMutationErrorPayloadUnionTypeResolver $postTagAddMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getPostTagAddMetaMutationErrorPayloadUnionTypeResolver() : PostTagAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagAddMetaMutationErrorPayloadUnionTypeResolver */
            $postTagAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagAddMetaMutationErrorPayloadUnionTypeResolver = $postTagAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostTagAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
