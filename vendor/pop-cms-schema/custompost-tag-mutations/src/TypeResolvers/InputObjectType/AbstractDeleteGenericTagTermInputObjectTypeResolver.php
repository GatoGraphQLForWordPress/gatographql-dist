<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractDeleteTagTermInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractDeleteGenericTagTermInputObjectTypeResolver extends AbstractDeleteTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\DeleteGenericTagTermInputObjectTypeResolverInterface
{
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
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getTagTaxonomyEnumStringScalarTypeResolver();
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
