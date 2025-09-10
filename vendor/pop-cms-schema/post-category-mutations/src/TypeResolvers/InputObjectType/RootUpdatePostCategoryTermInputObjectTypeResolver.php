<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootUpdateCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootUpdatePostCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\UpdatePostCategoryTermInputObjectTypeResolverInterface
{
    use RootUpdateCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootUpdatePostCategoryInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
