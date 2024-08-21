<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericCategoryTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryTermUpdateInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\UpdateGenericCategoryTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateInput';
    }
}
