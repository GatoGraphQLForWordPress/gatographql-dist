<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractDeleteCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\PostCategories\TypeResolvers\EnumType\PostCategoryTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractDeletePostCategoryTermInputObjectTypeResolver extends AbstractDeleteCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\DeletePostCategoryTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\EnumType\PostCategoryTaxonomyEnumStringScalarTypeResolver|null
     */
    private $postCategoryTaxonomyEnumStringScalarTypeResolver;
    public final function setPostCategoryTaxonomyEnumStringScalarTypeResolver(PostCategoryTaxonomyEnumStringScalarTypeResolver $postCategoryTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->postCategoryTaxonomyEnumStringScalarTypeResolver = $postCategoryTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getPostCategoryTaxonomyEnumStringScalarTypeResolver() : PostCategoryTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->postCategoryTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var PostCategoryTaxonomyEnumStringScalarTypeResolver */
            $postCategoryTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(PostCategoryTaxonomyEnumStringScalarTypeResolver::class);
            $this->postCategoryTaxonomyEnumStringScalarTypeResolver = $postCategoryTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->postCategoryTaxonomyEnumStringScalarTypeResolver;
    }
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getPostCategoryTaxonomyEnumStringScalarTypeResolver();
    }
}
