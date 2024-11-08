<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMutations\TypeResolvers\UnionType\PostUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class PostUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\UnionType\PostUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $postUpdateMutationErrorPayloadUnionTypeResolver;
    protected final function getPostUpdateMutationErrorPayloadUnionTypeResolver() : PostUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostUpdateMutationErrorPayloadUnionTypeResolver */
            $postUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->postUpdateMutationErrorPayloadUnionTypeResolver = $postUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getPostUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
