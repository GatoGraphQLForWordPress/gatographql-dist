<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateUserMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UpdateUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateUserMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
