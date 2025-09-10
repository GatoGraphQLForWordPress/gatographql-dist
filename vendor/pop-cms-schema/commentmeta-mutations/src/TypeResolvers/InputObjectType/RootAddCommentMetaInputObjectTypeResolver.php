<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootAddCommentMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractAddCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AddCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootAddCommentMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
