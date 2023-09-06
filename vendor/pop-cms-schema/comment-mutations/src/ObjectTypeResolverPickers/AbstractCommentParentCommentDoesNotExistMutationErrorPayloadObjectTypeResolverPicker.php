<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectModels\CommentParentCommentDoesNotExistErrorPayload;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
abstract class AbstractCommentParentCommentDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver;
    public final function setCommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver(CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver $commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver) : void
    {
        $this->commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver = $commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver;
    }
    protected final function getCommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver() : CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver */
            $commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver = $commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->commentParentCommentDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCommentParentCommentDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CommentParentCommentDoesNotExistErrorPayload::class;
    }
}
