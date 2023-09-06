<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType;

class RootSetFeaturedImageOnCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\AbstractSetFeaturedImageOnCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetFeaturedImageOnCustomPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
}
