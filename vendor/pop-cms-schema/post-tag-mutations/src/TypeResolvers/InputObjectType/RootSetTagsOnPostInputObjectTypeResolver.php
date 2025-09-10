<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetTagsOnPostInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetTagsOnPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
}
