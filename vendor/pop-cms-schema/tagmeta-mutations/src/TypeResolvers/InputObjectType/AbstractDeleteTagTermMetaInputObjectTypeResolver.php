<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteTaxonomyTermMetaInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteTagTermMetaInputObjectTypeResolver extends AbstractDeleteTaxonomyTermMetaInputObjectTypeResolver implements \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\DeleteTagTermMetaInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a tag term\'s meta entry', 'tagmeta-mutations');
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
