<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectModels\CommentAuthorNameIsMissingErrorPayload;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCommentAuthorNameIsMissingErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver $commentAuthorNameIsMissingErrorPayloadObjectTypeResolver = null;
    protected final function getCommentAuthorNameIsMissingErrorPayloadObjectTypeResolver() : CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver
    {
        if ($this->commentAuthorNameIsMissingErrorPayloadObjectTypeResolver === null) {
            /** @var CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver */
            $commentAuthorNameIsMissingErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentAuthorNameIsMissingErrorPayloadObjectTypeResolver::class);
            $this->commentAuthorNameIsMissingErrorPayloadObjectTypeResolver = $commentAuthorNameIsMissingErrorPayloadObjectTypeResolver;
        }
        return $this->commentAuthorNameIsMissingErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCommentAuthorNameIsMissingErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CommentAuthorNameIsMissingErrorPayload::class;
    }
}
