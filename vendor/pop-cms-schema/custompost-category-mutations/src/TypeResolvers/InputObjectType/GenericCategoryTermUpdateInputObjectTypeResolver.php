<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryTermUpdateInputObjectTypeResolverTrait;
/** @internal */
class GenericCategoryTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\UpdateGenericCategoryTermInputObjectTypeResolverInterface
{
    use CategoryTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
