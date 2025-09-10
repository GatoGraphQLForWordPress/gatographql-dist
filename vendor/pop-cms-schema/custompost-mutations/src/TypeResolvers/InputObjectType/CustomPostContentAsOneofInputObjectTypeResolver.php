<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostContentAsOneofInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractCustomPostContentAsOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CustomPostContentInput';
    }
}
