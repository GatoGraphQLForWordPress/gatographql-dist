<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractAddTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractAddCategoryTermMetaInputObjectTypeResolver extends AbstractAddTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AddCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to add meta to a category term', 'categorymeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the category', 'categorymeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
