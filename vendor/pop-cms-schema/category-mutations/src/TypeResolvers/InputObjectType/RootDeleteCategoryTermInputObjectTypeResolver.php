<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractDeleteCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\DeleteCategoryTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootDeleteCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeleteCategoryInput';
    }
}
