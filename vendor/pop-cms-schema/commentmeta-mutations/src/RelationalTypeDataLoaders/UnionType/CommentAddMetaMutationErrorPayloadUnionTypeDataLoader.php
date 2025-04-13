<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\CommentAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $commentAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getCommentAddMetaMutationErrorPayloadUnionTypeResolver() : CommentAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->commentAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CommentAddMetaMutationErrorPayloadUnionTypeResolver */
            $commentAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CommentAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->commentAddMetaMutationErrorPayloadUnionTypeResolver = $commentAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->commentAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCommentAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
