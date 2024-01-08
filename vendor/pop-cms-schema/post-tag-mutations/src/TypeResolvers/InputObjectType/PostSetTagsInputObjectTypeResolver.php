<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

/** @internal */
class PostSetTagsInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractSetTagsOnPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostSetTagsInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
