<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\ComponentProcessors\FormInputs;

use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Taxonomies\FilterInputs\TaxonomyFilterInput;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY = 'filterinput-post-tag-taxonomy';
    /**
     * @var \PoPCMSSchema\Taxonomies\FilterInputs\TaxonomyFilterInput|null
     */
    private $taxonomyFilterInput;
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\EnumType\PostTagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $postTagTaxonomyEnumStringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    public final function setTaxonomyFilterInput(TaxonomyFilterInput $taxonomyFilterInput) : void
    {
        $this->taxonomyFilterInput = $taxonomyFilterInput;
    }
    protected final function getTaxonomyFilterInput() : TaxonomyFilterInput
    {
        if ($this->taxonomyFilterInput === null) {
            /** @var TaxonomyFilterInput */
            $taxonomyFilterInput = $this->instanceManager->getInstance(TaxonomyFilterInput::class);
            $this->taxonomyFilterInput = $taxonomyFilterInput;
        }
        return $this->taxonomyFilterInput;
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
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY:
                return $this->getTaxonomyFilterInput();
            default:
                return null;
        }
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY:
                return 'taxonomy';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY:
                return $this->getPostTagTaxonomyEnumStringScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY:
                return $this->__('Post tag taxonomy', 'post-tags');
            default:
                return null;
        }
    }
    /**
     * @return mixed
     */
    public function getFilterInputDefaultValue(Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY:
                return $this->getPostTagTypeAPI()->getPostTagTaxonomyName();
            default:
                return null;
        }
    }
}
