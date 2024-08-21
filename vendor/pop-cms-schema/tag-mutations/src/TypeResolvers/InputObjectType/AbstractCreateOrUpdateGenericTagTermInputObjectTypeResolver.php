<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\MutateGenericTaxonomyTermInputObjectTypeResolverTrait;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateGenericTagTermInputObjectTypeResolverInterface, \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\CreateGenericTagTermInputObjectTypeResolverInterface
{
    use MutateGenericTaxonomyTermInputObjectTypeResolverTrait;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $tagTaxonomyEnumStringScalarTypeResolver;
    public final function setTagTaxonomyEnumStringScalarTypeResolver(TagTaxonomyEnumStringScalarTypeResolver $tagTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->tagTaxonomyEnumStringScalarTypeResolver = $tagTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getTagTaxonomyEnumStringScalarTypeResolver() : TagTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->tagTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var TagTaxonomyEnumStringScalarTypeResolver */
            $tagTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(TagTaxonomyEnumStringScalarTypeResolver::class);
            $this->tagTaxonomyEnumStringScalarTypeResolver = $tagTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->tagTaxonomyEnumStringScalarTypeResolver;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), $this->getGenericTaxonomyTermInputFieldNameTypeResolvers());
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return $this->getGenericTaxonomyTermInputFieldDescription($inputFieldName) ?? parent::getInputFieldDescription($inputFieldName);
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return $this->getGenericTaxonomyTermInputFieldTypeModifiers($inputFieldName) ?? parent::getInputFieldTypeModifiers($inputFieldName);
    }
    protected function getGenericTaxonomyTermTaxonomyInputTypeResolver() : InputTypeResolverInterface
    {
        return $this->getTagTaxonomyEnumStringScalarTypeResolver();
    }
}
