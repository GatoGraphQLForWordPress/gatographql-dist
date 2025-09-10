<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostAddMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractAddCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AddCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CustomPostAddMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
