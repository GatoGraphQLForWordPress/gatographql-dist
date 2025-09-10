<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCustomPostMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractSetCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\SetCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootSetCustomPostMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
