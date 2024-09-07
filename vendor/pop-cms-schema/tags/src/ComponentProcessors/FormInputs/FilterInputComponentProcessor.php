<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\ComponentProcessors\FormInputs;

use PoPCMSSchema\Tags\FilterInputs\TagIDsFilterInput;
use PoPCMSSchema\Tags\FilterInputs\TagSlugsFilterInput;
use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Taxonomies\FilterInputs\TaxonomyFilterInput;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\FormInputs\FormMultipleInput;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_TAG_SLUGS = 'filterinput-tag-slugs';
    public const COMPONENT_FILTERINPUT_TAG_IDS = 'filterinput-tag-ids';
    public const COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY = 'filterinput-generic-tag-taxonomy';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\FilterInputs\TagSlugsFilterInput|null
     */
    private $tagSlugsFilterInput;
    /**
     * @var \PoPCMSSchema\Tags\FilterInputs\TagIDsFilterInput|null
     */
    private $tagIDsFilterInput;
    /**
     * @var \PoPCMSSchema\Taxonomies\FilterInputs\TaxonomyFilterInput|null
     */
    private $taxonomyFilterInput;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $tagTaxonomyEnumStringScalarTypeResolver;
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    public final function setTagSlugsFilterInput(TagSlugsFilterInput $tagSlugsFilterInput) : void
    {
        $this->tagSlugsFilterInput = $tagSlugsFilterInput;
    }
    protected final function getTagSlugsFilterInput() : TagSlugsFilterInput
    {
        if ($this->tagSlugsFilterInput === null) {
            /** @var TagSlugsFilterInput */
            $tagSlugsFilterInput = $this->instanceManager->getInstance(TagSlugsFilterInput::class);
            $this->tagSlugsFilterInput = $tagSlugsFilterInput;
        }
        return $this->tagSlugsFilterInput;
    }
    public final function setTagIDsFilterInput(TagIDsFilterInput $tagIDsFilterInput) : void
    {
        $this->tagIDsFilterInput = $tagIDsFilterInput;
    }
    protected final function getTagIDsFilterInput() : TagIDsFilterInput
    {
        if ($this->tagIDsFilterInput === null) {
            /** @var TagIDsFilterInput */
            $tagIDsFilterInput = $this->instanceManager->getInstance(TagIDsFilterInput::class);
            $this->tagIDsFilterInput = $tagIDsFilterInput;
        }
        return $this->tagIDsFilterInput;
    }
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
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_TAG_SLUGS, self::COMPONENT_FILTERINPUT_TAG_IDS, self::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
                return $this->getTagSlugsFilterInput();
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return $this->getTagIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY:
                return $this->getTaxonomyFilterInput();
            default:
                return null;
        }
    }
    public function getInputClass(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return FormMultipleInput::class;
        }
        return parent::getInputClass($component);
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
                return 'tagSlugs';
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return 'tagIDs';
            case self::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY:
                return 'taxonomy';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY:
                return $this->getTagTaxonomyEnumStringScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_TAG_SLUGS:
                return $this->__('Limit results to elements with the given tags', 'tags');
            case self::COMPONENT_FILTERINPUT_TAG_IDS:
                return $this->__('Limit results to elements with the given ids', 'tags');
            case self::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY:
                return $this->__('Tag taxonomy', 'tags');
            default:
                return null;
        }
    }
}
