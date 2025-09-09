<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdatePostTagTermInputObjectTypeResolver extends AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\UpdatePostTagTermInputObjectTypeResolverInterface, \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\CreatePostTagTermInputObjectTypeResolverInterface
{
    private ?PostTagTaxonomyEnumStringScalarTypeResolver $postTagTaxonomyEnumStringScalarTypeResolver = null;
    private ?PostTagTypeAPIInterface $postTagTypeAPI = null;
    protected final function getPostTagTaxonomyEnumStringScalarTypeResolver() : PostTagTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->postTagTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var PostTagTaxonomyEnumStringScalarTypeResolver */
            $postTagTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(PostTagTaxonomyEnumStringScalarTypeResolver::class);
            $this->postTagTaxonomyEnumStringScalarTypeResolver = $postTagTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->postTagTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getPostTagTypeAPI() : PostTagTypeAPIInterface
    {
        if ($this->postTagTypeAPI === null) {
            /** @var PostTagTypeAPIInterface */
            $postTagTypeAPI = $this->instanceManager->getInstance(PostTagTypeAPIInterface::class);
            $this->postTagTypeAPI = $postTagTypeAPI;
        }
        return $this->postTagTypeAPI;
    }
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getPostTagTaxonomyEnumStringScalarTypeResolver();
    }
    protected function getTaxonomyInputFieldDefaultValue() : mixed
    {
        $postTagTaxonomyName = $this->getPostTagTypeAPI()->getPostTagTaxonomyName();
        if (!\in_array($postTagTaxonomyName, $this->getPostTagTaxonomyEnumStringScalarTypeResolver()->getConsolidatedPossibleValues())) {
            return null;
        }
        return $postTagTaxonomyName;
    }
}
