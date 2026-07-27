<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

/** @internal */
class CommentDeleteInputObjectTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\AbstractDeleteCommentInputObjectTypeResolver
{
    protected function addIDInputField() : bool
    {
        return \false;
    }
    public function getTypeName() : string
    {
        return 'CommentDeleteInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a comment (nested mutations)', 'gatographql');
    }
}
