<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

/** @internal */
class CommentReplyInputObjectTypeResolver extends \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\AbstractAddCommentToCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CommentReplyInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to reply to a comment', 'comment-mutations');
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
    protected function addParentCommentInputField() : bool
    {
        return \false;
    }
    protected function isParentCommentInputFieldMandatory() : bool
    {
        return \false;
    }
}
