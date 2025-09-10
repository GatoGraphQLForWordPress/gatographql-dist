<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\RootReplyCommentMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootReplyCommentMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootReplyCommentMutationErrorPayloadUnionTypeResolver $rootReplyCommentMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootReplyCommentMutationErrorPayloadUnionTypeResolver() : RootReplyCommentMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootReplyCommentMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootReplyCommentMutationErrorPayloadUnionTypeResolver */
            $rootReplyCommentMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootReplyCommentMutationErrorPayloadUnionTypeResolver::class);
            $this->rootReplyCommentMutationErrorPayloadUnionTypeResolver = $rootReplyCommentMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootReplyCommentMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootReplyCommentMutationErrorPayloadUnionTypeResolver();
    }
}
