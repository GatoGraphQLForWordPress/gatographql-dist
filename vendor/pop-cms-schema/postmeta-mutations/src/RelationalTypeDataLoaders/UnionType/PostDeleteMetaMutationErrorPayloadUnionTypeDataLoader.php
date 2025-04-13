<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostDeleteMetaMutationErrorPayloadUnionTypeResolver() : PostDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $postDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postDeleteMetaMutationErrorPayloadUnionTypeResolver = $postDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
