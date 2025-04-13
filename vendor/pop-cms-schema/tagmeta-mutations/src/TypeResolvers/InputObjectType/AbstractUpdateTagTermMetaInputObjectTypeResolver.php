<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractUpdateTagTermMetaInputObjectTypeResolver extends AbstractUpdateTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\UpdateTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a tag term\'s meta', 'tagmeta-mutations');
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
