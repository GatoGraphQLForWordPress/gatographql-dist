<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostSetMetaMutationErrorPayloadUnionTypeResolver() : PostSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostSetMetaMutationErrorPayloadUnionTypeResolver */
            $postSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postSetMetaMutationErrorPayloadUnionTypeResolver = $postSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
