<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class TagTermUpdateMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\UpdateTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'TagUpdateMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
