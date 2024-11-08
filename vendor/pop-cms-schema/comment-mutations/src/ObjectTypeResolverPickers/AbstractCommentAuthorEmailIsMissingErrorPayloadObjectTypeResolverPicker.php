<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectModels\CommentAuthorEmailIsMissingErrorPayload;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCommentAuthorEmailIsMissingErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver|null
     */
    private $commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver;
    protected final function getCommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver() : CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver
    {
        if ($this->commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver === null) {
            /** @var CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver */
            $commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver::class);
            $this->commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver = $commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver;
        }
        return $this->commentAuthorEmailIsMissingErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCommentAuthorEmailIsMissingErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CommentAuthorEmailIsMissingErrorPayload::class;
    }
}
