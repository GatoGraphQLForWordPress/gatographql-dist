<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootAddCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootAddCommentMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootAddCommentMetaMutationErrorPayloadUnionTypeResolver $rootAddCommentMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootAddCommentMetaMutationErrorPayloadUnionTypeResolver() : RootAddCommentMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddCommentMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddCommentMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddCommentMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddCommentMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddCommentMetaMutationErrorPayloadUnionTypeResolver = $rootAddCommentMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddCommentMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddCommentMetaMutationErrorPayloadUnionTypeResolver();
    }
}
