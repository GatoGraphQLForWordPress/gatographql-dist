<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCommentMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\DeleteCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteCommentMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
