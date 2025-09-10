<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?PostAddMetaMutationErrorPayloadUnionTypeResolver $postAddMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getPostAddMetaMutationErrorPayloadUnionTypeResolver() : PostAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostAddMetaMutationErrorPayloadUnionTypeResolver */
            $postAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postAddMetaMutationErrorPayloadUnionTypeResolver = $postAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
