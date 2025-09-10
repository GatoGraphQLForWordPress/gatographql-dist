<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver extends AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\UpdateGenericTagTermInputObjectTypeResolverInterface, \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\CreateGenericTagTermInputObjectTypeResolverInterface
{
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
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getTagTaxonomyEnumStringScalarTypeResolver();
    }
    protected function getTaxonomyInputFieldDefaultValue() : mixed
    {
        return null;
    }
}
