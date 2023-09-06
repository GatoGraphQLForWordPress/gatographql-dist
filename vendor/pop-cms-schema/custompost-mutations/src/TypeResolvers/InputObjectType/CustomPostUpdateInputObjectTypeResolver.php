<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

class CustomPostUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCustomPostInputObjectTypeResolver implements \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\UpdateCustomPostInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CustomPostUpdateInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
