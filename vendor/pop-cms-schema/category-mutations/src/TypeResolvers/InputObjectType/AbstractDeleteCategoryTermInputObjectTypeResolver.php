<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\AbstractDeleteTaxonomyTermInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteCategoryTermInputObjectTypeResolver extends AbstractDeleteTaxonomyTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\DeleteCategoryTermInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a category term', 'category-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the category to delete', 'category-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
