<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateCommentMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\AbstractCommentMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateCommentMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta mutation on a comment', 'comment-mutations');
    }
}
