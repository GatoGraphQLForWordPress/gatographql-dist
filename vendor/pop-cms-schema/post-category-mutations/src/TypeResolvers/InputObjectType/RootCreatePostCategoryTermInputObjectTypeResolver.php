<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootCreateCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootCreatePostCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\CreatePostCategoryTermInputObjectTypeResolverInterface
{
    use RootCreateCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreatePostCategoryInput';
    }
}
