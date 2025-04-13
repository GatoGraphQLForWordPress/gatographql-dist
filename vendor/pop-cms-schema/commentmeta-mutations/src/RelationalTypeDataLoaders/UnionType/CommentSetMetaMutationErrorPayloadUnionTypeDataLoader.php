<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $commentSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getCommentSetMetaMutationErrorPayloadUnionTypeResolver() : CommentSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentSetMetaMutationErrorPayloadUnionTypeResolver */
            $commentSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->commentSetMetaMutationErrorPayloadUnionTypeResolver = $commentSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCommentSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
