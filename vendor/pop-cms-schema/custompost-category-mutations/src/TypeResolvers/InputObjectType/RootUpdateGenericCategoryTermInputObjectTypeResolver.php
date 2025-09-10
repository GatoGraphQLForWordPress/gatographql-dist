<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\RootUpdateCategoryTermInputObjectTypeResolverTrait;
/** @internal */
class RootUpdateGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\UpdateGenericCategoryTermInputObjectTypeResolverInterface
{
    use RootUpdateCategoryTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootUpdateGenericCategoryInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
