<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootDeleteCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootDeleteGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractDeleteGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\DeleteGenericCategoryTermInputObjectTypeResolverInterface
{
    use RootDeleteCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCategoryInput';
    }
}
