<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\CommentDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?CommentDeleteMutationErrorPayloadUnionTypeResolver $commentDeleteMutationErrorPayloadUnionTypeResolver = null;
    protected final function getCommentDeleteMutationErrorPayloadUnionTypeResolver() : CommentDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentDeleteMutationErrorPayloadUnionTypeResolver */
            $commentDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->commentDeleteMutationErrorPayloadUnionTypeResolver = $commentDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCommentDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
