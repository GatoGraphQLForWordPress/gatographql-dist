<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\InputObjectType;

use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class CustomPostsFilterCustomPostsByTagsInputObjectTypeResolver extends \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\AbstractFilterCustomPostsByTagsInputObjectTypeResolver
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
    public function getTypeName() : string
    {
        return 'FilterCustomPostsByTagsInput';
    }
    protected function getTagTaxonomyFilterInput() : InputTypeResolverInterface
    {
        return $this->getTagTaxonomyEnumStringScalarTypeResolver();
    }
    /**
     * @return mixed
     */
    protected function getTagTaxonomyFilterDefaultValue()
    {
        return null;
    }
}
