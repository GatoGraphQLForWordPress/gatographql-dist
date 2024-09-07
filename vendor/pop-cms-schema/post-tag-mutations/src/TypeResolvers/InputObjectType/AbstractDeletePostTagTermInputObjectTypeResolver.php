<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractDeleteTagTermInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractDeletePostTagTermInputObjectTypeResolver extends AbstractDeleteTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\DeletePostTagTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $postTagTaxonomyEnumStringScalarTypeResolver;
    public final function setPostTagTaxonomyEnumStringScalarTypeResolver(PostTagTaxonomyEnumStringScalarTypeResolver $postTagTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->postTagTaxonomyEnumStringScalarTypeResolver = $postTagTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getPostTagTaxonomyEnumStringScalarTypeResolver() : PostTagTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->postTagTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var PostTagTaxonomyEnumStringScalarTypeResolver */
            $postTagTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(PostTagTaxonomyEnumStringScalarTypeResolver::class);
            $this->postTagTaxonomyEnumStringScalarTypeResolver = $postTagTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->postTagTaxonomyEnumStringScalarTypeResolver;
    }
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getPostTagTaxonomyEnumStringScalarTypeResolver();
    }
}
