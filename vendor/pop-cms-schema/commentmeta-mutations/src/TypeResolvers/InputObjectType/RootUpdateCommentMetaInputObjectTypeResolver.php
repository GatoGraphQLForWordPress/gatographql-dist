<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateCommentMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\UpdateCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateCommentMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
