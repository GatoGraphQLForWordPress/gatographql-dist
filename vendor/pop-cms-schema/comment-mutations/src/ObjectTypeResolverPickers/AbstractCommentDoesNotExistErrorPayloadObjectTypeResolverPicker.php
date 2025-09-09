<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectModels\CommentDoesNotExistErrorPayload;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCommentDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?CommentDoesNotExistErrorPayloadObjectTypeResolver $commentDoesNotExistErrorPayloadObjectTypeResolver = null;
    protected final function getCommentDoesNotExistErrorPayloadObjectTypeResolver() : CommentDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->commentDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var CommentDoesNotExistErrorPayloadObjectTypeResolver */
            $commentDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->commentDoesNotExistErrorPayloadObjectTypeResolver = $commentDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->commentDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCommentDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CommentDoesNotExistErrorPayload::class;
    }
}
