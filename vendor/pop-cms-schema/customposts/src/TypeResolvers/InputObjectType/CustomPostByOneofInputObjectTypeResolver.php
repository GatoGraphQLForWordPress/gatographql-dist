<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType;

/** @internal */
class CustomPostByOneofInputObjectTypeResolver extends \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractCustomPostByOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'CustomPostByInput';
    }
}
