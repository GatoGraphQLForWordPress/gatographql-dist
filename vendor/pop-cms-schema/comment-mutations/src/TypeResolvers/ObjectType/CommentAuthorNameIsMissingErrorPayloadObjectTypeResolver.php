<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CommentMutations\RelationalTypeDataLoaders\ObjectType\CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader|null
     */
    private $commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader;
    public final function setCommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader(CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader $commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader) : void
    {
        $this->commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader = $commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader;
    }
    protected final function getCommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader() : CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader
    {
        if ($this->commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader === null) {
            /** @var CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader */
            $commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(CommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader::class);
            $this->commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader = $commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader;
        }
        return $this->commentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CommentAuthorNameIsMissingErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The comment\'s author name is missing"', 'comment-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCommentAuthorNameIsMissingErrorPayloadObjectTypeDataLoader();
    }
}
