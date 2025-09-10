<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateCustomPostMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\UpdateCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootUpdateCustomPostMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
