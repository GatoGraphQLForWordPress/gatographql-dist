<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?CommentDeleteMetaMutationErrorPayloadUnionTypeResolver $commentDeleteMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getCommentDeleteMetaMutationErrorPayloadUnionTypeResolver() : CommentDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $commentDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver = $commentDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCommentDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
