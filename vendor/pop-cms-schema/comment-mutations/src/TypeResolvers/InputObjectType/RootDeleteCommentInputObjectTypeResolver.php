<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCommentInputObjectTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\AbstractDeleteCommentInputObjectTypeResolver
{
    protected function addIDInputField() : bool
    {
        return \true;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteCommentInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a comment', 'gatographql');
    }
}
