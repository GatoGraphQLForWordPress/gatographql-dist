<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteCommentMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\AbstractCommentMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteCommentMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of deleting a comment', 'gatographql');
    }
}
