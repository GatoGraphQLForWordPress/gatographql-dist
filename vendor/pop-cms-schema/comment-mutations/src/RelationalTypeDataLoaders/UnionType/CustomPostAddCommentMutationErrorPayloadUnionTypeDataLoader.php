<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\CustomPostAddCommentMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\CustomPostAddCommentMutationErrorPayloadUnionTypeResolver|null
     */
    private $customPostAddCommentMutationErrorPayloadUnionTypeResolver;
    protected final function getCustomPostAddCommentMutationErrorPayloadUnionTypeResolver() : CustomPostAddCommentMutationErrorPayloadUnionTypeResolver
    {
        if ($this->customPostAddCommentMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CustomPostAddCommentMutationErrorPayloadUnionTypeResolver */
            $customPostAddCommentMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CustomPostAddCommentMutationErrorPayloadUnionTypeResolver::class);
            $this->customPostAddCommentMutationErrorPayloadUnionTypeResolver = $customPostAddCommentMutationErrorPayloadUnionTypeResolver;
        }
        return $this->customPostAddCommentMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getCustomPostAddCommentMutationErrorPayloadUnionTypeResolver();
    }
}
