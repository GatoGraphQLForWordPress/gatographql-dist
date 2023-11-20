<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\ObjectModels\CommentsAreNotOpenForCustomPostErrorPayload;
use PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCommentsAreNotOpenForCustomPostMutationErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver|null
     */
    private $commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver;
    public final function setCommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver(CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver $commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver) : void
    {
        $this->commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver = $commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver;
    }
    protected final function getCommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver() : CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver
    {
        if ($this->commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver === null) {
            /** @var CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver */
            $commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver::class);
            $this->commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver = $commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver;
        }
        return $this->commentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCommentsAreNotOpenForCustomPostErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CommentsAreNotOpenForCustomPostErrorPayload::class;
    }
}
