<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostSetMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractSetCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\SetCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CustomPostSetMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
