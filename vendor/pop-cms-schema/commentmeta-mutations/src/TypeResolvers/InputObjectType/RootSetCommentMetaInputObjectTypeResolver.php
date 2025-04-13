<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCommentMetaInputObjectTypeResolver extends \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\AbstractSetCommentMetaInputObjectTypeResolver implements \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\SetCommentMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootSetCommentMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
