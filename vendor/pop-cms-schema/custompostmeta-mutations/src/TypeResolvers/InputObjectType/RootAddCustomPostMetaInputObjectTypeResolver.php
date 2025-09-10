<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootAddCustomPostMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractAddCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AddCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootAddCustomPostMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
