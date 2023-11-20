<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetTagsOnCustomPostInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnPostInputObjectTypeResolver
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
