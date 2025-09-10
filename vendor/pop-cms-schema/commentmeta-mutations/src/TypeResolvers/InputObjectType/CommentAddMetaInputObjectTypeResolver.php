<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CommentAddMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractAddCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AddCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CommentAddMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
