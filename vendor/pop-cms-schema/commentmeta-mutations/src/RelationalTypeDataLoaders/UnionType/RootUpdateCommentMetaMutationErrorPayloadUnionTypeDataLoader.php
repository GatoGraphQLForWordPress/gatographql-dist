<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateCommentMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\UnionType\RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver() : RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver = $rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateCommentMetaMutationErrorPayloadUnionTypeResolver();
    }
}
