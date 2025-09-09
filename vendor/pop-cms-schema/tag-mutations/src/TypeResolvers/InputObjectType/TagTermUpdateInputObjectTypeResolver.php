<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class TagTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateTagTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolverTrait;
    private ?TagTaxonomyEnumStringScalarTypeResolver $tagTaxonomyEnumStringScalarTypeResolver = null;
    protected final function getTagTaxonomyEnumStringScalarTypeResolver() : TagTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->tagTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var TagTaxonomyEnumStringScalarTypeResolver */
            $tagTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(TagTaxonomyEnumStringScalarTypeResolver::class);
            $this->tagTaxonomyEnumStringScalarTypeResolver = $tagTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->tagTaxonomyEnumStringScalarTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'TagUpdateInput';
    }
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getTagTaxonomyEnumStringScalarTypeResolver();
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
    protected function getTaxonomyInputFieldDefaultValue() : mixed
    {
        return null;
    }
}
