<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\AbstractDeleteEntityMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteTaxonomyTermMetaInputObjectTypeResolver extends AbstractDeleteEntityMetaInputObjectTypeResolver implements \PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\DeleteTaxonomyTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a taxonomy term\'s meta entry', 'taxonomymeta-mutations');
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
