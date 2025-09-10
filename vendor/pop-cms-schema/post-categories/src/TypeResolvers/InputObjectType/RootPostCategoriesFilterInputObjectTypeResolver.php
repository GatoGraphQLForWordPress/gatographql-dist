<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\AbstractCategoriesFilterInputObjectTypeResolver;
/** @internal */
class RootPostCategoriesFilterInputObjectTypeResolver extends AbstractCategoriesFilterInputObjectTypeResolver implements \PoPCMSSchema\PostCategories\TypeResolvers\InputObjectType\PostCategoriesFilterInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootPostCategoriesFilterInput';
    }
}
