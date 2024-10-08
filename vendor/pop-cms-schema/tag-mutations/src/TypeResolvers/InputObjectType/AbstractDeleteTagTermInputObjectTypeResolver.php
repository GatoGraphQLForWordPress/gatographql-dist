<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\AbstractDeleteTaxonomyTermInputObjectTypeResolver;
/** @internal */
abstract class AbstractDeleteTagTermInputObjectTypeResolver extends AbstractDeleteTaxonomyTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\DeleteTagTermInputObjectTypeResolverInterface
{
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a tag term', 'tag-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the tag to delete', 'tag-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
