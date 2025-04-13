<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractSetTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractSetCategoryTermMetaInputObjectTypeResolver extends AbstractSetTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\SetCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set a category term\'s meta entries', 'categorymeta-mutations');
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
