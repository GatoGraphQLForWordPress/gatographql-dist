<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class CommentAddMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\AbstractCommentMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CommentAddMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an add meta nested mutation on a comment', 'comment-mutations');
    }
}
