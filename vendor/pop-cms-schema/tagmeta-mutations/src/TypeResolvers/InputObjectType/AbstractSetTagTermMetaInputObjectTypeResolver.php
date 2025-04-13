<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractSetTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractSetTagTermMetaInputObjectTypeResolver extends AbstractSetTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\SetTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set a tag term\'s meta entries', 'tagmeta-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the tag', 'tagmeta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
