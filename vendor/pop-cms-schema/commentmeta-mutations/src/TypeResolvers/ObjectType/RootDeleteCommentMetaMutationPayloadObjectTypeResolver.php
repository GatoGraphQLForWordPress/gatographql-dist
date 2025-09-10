<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteCommentMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\AbstractCommentMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteCommentMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a comment', 'comment-mutations');
    }
}
