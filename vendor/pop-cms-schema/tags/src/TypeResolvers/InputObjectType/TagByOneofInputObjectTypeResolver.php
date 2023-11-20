<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\AbstractTagByOneofInputObjectTypeResolver;
/** @internal */
class TagByOneofInputObjectTypeResolver extends AbstractTagByOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'TagByInput';
    }
}
