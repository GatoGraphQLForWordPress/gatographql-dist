<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostSetFeaturedImageInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\AbstractSetFeaturedImageOnCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CustomPostSetFeaturedImageInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
