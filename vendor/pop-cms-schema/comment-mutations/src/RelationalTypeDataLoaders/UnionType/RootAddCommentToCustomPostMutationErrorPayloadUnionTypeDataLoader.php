<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
class RootAddCommentToCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver(RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver $rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver = $rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver() : RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver = $rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddCommentToCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
