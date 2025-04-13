<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class TagTermSetMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractSetTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\SetTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'TagSetMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
