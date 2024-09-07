<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\TypeResolvers\InputObjectType;

use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\AbstractFilterCustomPostsByTagsInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class PostsFilterCustomPostsByTagsInputObjectTypeResolver extends AbstractFilterCustomPostsByTagsInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $postTagTaxonomyEnumStringScalarTypeResolver;
    public final function setPostTagTypeAPI(PostTagTypeAPIInterface $postTagTypeAPI) : void
    {
        $this->postTagTypeAPI = $postTagTypeAPI;
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
    public function getTypeName() : string
    {
        return 'FilterPostsByTagsInput';
    }
    protected function getTagTaxonomyFilterInput() : InputTypeResolverInterface
    {
        return $this->getPostTagTaxonomyEnumStringScalarTypeResolver();
    }
    /**
     * @return mixed
     */
    protected function getTagTaxonomyFilterDefaultValue()
    {
        $postTagTaxonomyName = $this->getPostTagTypeAPI()->getPostTagTaxonomyName();
        if (!\in_array($postTagTaxonomyName, $this->getPostTagTaxonomyEnumStringScalarTypeResolver()->getConsolidatedPossibleValues())) {
            return null;
        }
        return $postTagTaxonomyName;
    }
}
