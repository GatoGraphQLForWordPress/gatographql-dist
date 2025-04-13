<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootSetCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetCommentMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootSetCommentMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetCommentMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetCommentMetaMutationErrorPayloadUnionTypeResolver() : RootSetCommentMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetCommentMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetCommentMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetCommentMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetCommentMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetCommentMetaMutationErrorPayloadUnionTypeResolver = $rootSetCommentMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetCommentMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetCommentMetaMutationErrorPayloadUnionTypeResolver();
    }
}
