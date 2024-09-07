<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetTagsOnCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnGenericCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetTagsOnCustomPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
}
