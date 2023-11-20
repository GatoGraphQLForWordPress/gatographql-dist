<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader|null
     */
    private $commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader;
    public final function setCommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader(CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader $commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader) : void
    {
        $this->commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader = $commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader;
    }
    protected final function getCommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader() : CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader
    {
        if ($this->commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader === null) {
            /** @var CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader */
            $commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(CommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader::class);
            $this->commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader = $commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader;
        }
        return $this->commentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CommentsAreNotSupportedByCustomPostTypeErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "Comments are not supported by the custom post type"', 'comment-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCommentsAreNotSupportedByCustomPostTypeErrorPayloadObjectTypeDataLoader();
    }
}
