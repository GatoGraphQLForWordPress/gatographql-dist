<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\PostTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\PostTagDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostTagDeleteMetaMutationErrorPayloadUnionTypeResolver() : PostTagDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postTagDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostTagDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $postTagDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostTagDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postTagDeleteMetaMutationErrorPayloadUnionTypeResolver = $postTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostTagDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
