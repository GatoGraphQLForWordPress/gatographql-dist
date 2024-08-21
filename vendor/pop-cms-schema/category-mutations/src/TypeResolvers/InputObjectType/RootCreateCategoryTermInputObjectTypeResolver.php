<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CreateCategoryTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootCreateCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreateCategoryInput';
    }
}
