<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType;

/** @internal */
class CommentUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\ObjectType\AbstractCommentMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CommentUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of updating a comment (nested mutations)', 'gatographql');
    }
}
