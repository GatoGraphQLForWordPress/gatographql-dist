<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateTagTermMetaInputObjectTypeResolver extends \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateTagTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\UpdateTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateTagMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
