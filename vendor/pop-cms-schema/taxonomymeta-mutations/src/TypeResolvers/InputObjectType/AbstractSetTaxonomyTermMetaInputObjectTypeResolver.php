<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractSetEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractSetTaxonomyTermMetaInputObjectTypeResolver extends AbstractSetEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\SetTaxonomyTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set entries on a taxonomy term', 'taxonomymeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the taxonomy term', 'taxonomymeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
