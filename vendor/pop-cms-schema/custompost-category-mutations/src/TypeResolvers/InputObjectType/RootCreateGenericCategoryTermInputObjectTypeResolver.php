<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootCreateCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootCreateGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CreateGenericCategoryTermInputObjectTypeResolverInterface
{
    use RootCreateCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreateGenericCategoryInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \true;
    }
}
