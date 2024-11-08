<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType\CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class CustomPostAddCommentMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\AbstractCommentMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\UnionType\CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $customPostAddCommentMutationErrorPayloadUnionTypeDataLoader;
    protected final function getCustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader() : CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->customPostAddCommentMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader */
            $customPostAddCommentMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(CustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader::class);
            $this->customPostAddCommentMutationErrorPayloadUnionTypeDataLoader = $customPostAddCommentMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->customPostAddCommentMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CustomPostAddCommentMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding a comment to a custom post (using nested mutations)', 'comment-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCustomPostAddCommentMutationErrorPayloadUnionTypeDataLoader();
    }
}
