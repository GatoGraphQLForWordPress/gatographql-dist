<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostUpdateMetaInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateCustomPostMetaInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\UpdateCustomPostMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CustomPostUpdateMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
