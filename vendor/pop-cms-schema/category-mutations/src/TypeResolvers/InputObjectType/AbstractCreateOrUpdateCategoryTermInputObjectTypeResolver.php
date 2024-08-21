<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTaxonomyTermInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver extends AbstractCreateOrUpdateTaxonomyTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\UpdateCategoryTermInputObjectTypeResolverInterface, \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CreateCategoryTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver|null
     */
    private $parentCategoryByOneofInputObjectTypeResolver;
    public final function setCategoryByOneofInputObjectTypeResolver(\PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver $parentCategoryByOneofInputObjectTypeResolver) : void
    {
        $this->parentCategoryByOneofInputObjectTypeResolver = $parentCategoryByOneofInputObjectTypeResolver;
    }
    protected final function getCategoryByOneofInputObjectTypeResolver() : \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver
    {
        if ($this->parentCategoryByOneofInputObjectTypeResolver === null) {
            /** @var CategoryByOneofInputObjectTypeResolver */
            $parentCategoryByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver::class);
            $this->parentCategoryByOneofInputObjectTypeResolver = $parentCategoryByOneofInputObjectTypeResolver;
        }
        return $this->parentCategoryByOneofInputObjectTypeResolver;
    }
    protected function getTaxonomyTermParentInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getCategoryByOneofInputObjectTypeResolver();
    }
    protected function addParentIDInputField() : bool
    {
        return \true;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to create or update a category term', 'category-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the category to update', 'category-mutations');
            case MutationInputProperties::NAME:
                return $this->__('The name of the category', 'category-mutations');
            case MutationInputProperties::DESCRIPTION:
                return $this->__('The description of the category', 'category-mutations');
            case MutationInputProperties::SLUG:
                return $this->__('The slug of the category', 'category-mutations');
            case MutationInputProperties::PARENT_BY:
                return $this->__('The category\'s parent, or `null` to remove it', 'category-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
