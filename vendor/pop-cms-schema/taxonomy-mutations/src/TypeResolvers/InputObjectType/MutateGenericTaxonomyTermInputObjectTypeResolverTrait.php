<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
trait MutateGenericTaxonomyTermInputObjectTypeResolverTrait
{
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getGenericTaxonomyTermInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::TAXONOMY => $this->getGenericTaxonomyTermTaxonomyInputTypeResolver()];
    }
    protected abstract function getGenericTaxonomyTermTaxonomyInputTypeResolver() : InputTypeResolverInterface;
    public function getGenericTaxonomyTermInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::TAXONOMY:
                return $this->__('The taxonomy', 'taxonomy-mutations');
            default:
                return null;
        }
    }
    public function getGenericTaxonomyTermInputFieldTypeModifiers(string $inputFieldName) : ?int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::TAXONOMY:
                return $this->isTaxonomyInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE;
            default:
                return null;
        }
    }
    protected abstract function isTaxonomyInputFieldMandatory() : bool;
}
