<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\AbstractCategoryByOneofInputObjectTypeResolver;
/** @internal */
class PostCategoryByOneofInputObjectTypeResolver extends AbstractCategoryByOneofInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostCategoryByFilterInput';
    }
}
