<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader|null
     */
    private $commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader;
    protected final function getCommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader() : CommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader
    {
        if ($this->commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader === null) {
            /** @var CommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader */
            $commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(CommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader::class);
            $this->commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader = $commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader;
        }
        return $this->commentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CommentAuthorEmailIsMissingErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The comment\'s author email is missing"', 'comment-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCommentAuthorEmailIsMissingErrorPayloadObjectTypeDataLoader();
    }
}
