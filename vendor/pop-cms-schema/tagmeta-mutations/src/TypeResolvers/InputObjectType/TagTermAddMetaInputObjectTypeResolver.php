<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class TagTermAddMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractAddTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AddTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'TagAddMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
