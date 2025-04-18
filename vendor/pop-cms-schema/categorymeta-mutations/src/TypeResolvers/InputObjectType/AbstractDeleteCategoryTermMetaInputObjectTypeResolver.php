<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteCategoryTermMetaInputObjectTypeResolver extends AbstractDeleteTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\DeleteCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a category term\'s meta entry', 'categorymeta-mutations');
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
