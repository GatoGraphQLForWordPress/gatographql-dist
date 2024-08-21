<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootDeleteCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootDeletePostCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractDeletePostCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\DeletePostCategoryTermInputObjectTypeResolverInterface
{
    use RootDeleteCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootDeletePostCategoryInput';
    }
}
