<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostDeleteMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\DeleteCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CustomPostDeleteMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
