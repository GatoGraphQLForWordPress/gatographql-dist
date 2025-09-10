<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericCustomPostSetTagsInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnGenericCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostSetTagsInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
