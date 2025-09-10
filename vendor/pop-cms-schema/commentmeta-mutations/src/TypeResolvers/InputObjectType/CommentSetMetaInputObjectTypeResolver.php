<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CommentSetMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractSetCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\SetCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CommentSetMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
