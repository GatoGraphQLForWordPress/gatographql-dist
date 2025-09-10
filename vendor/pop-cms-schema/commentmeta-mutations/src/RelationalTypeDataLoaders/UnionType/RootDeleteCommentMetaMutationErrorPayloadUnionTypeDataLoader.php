<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeleteCommentMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver $rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver() : RootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver = $rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeleteCommentMetaMutationErrorPayloadUnionTypeResolver();
    }
}
