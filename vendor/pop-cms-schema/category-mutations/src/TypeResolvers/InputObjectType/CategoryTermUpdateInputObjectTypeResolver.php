<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class CategoryTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\UpdateCategoryTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'CategoryUpdateInput';
    }
}
