<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryTermUpdateInputObjectTypeResolverTrait;
/** @internal */
class PostCategoryTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\UpdatePostCategoryTermInputObjectTypeResolverInterface
{
    use CategoryTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'PostCategoryUpdateInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
