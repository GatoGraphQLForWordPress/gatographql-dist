<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCustomPostMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\DeleteCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteCustomPostMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
