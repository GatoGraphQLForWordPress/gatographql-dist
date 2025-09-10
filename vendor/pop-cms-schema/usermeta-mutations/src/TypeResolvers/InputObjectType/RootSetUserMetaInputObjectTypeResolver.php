<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetUserMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractSetUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\SetUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootSetUserMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
