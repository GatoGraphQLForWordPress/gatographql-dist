<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\FormInputs\FormMultipleInput;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\Tokens\Param;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Engine\FormInputs\BooleanFormInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeParentIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\FormatFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\GMTFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\LimitFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\OffsetFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SortFilterInput;
use PoPCMSSchema\SchemaCommons\FormInputs\MultiValueFromStringFormInput;
use PoPCMSSchema\SchemaCommons\FormInputs\OrderFormInput;
/** @internal */
class CommonFilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_SORT = 'filterinput-sort';
    public const COMPONENT_FILTERINPUT_LIMIT = 'filterinput-limit';
    public const COMPONENT_FILTERINPUT_OFFSET = 'filterinput-offset';
    public const COMPONENT_FILTERINPUT_SEARCH = 'filterinput-search';
    public const COMPONENT_FILTERINPUT_IDS = 'filterinput-ids';
    public const COMPONENT_FILTERINPUT_ID = 'filterinput-id';
    public const COMPONENT_FILTERINPUT_COMMASEPARATED_IDS = 'filterinput-commaseparated-ids';
    public const COMPONENT_FILTERINPUT_EXCLUDE_IDS = 'filterinput-exclude-ids';
    public const COMPONENT_FILTERINPUT_PARENT_IDS = 'filterinput-parent-ids';
    public const COMPONENT_FILTERINPUT_PARENT_ID = 'filterinput-parent-id';
    public const COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS = 'filterinput-exclude-parent-ids';
    public const COMPONENT_FILTERINPUT_SLUGS = 'filterinput-slugs';
    public const COMPONENT_FILTERINPUT_SLUG = 'filterinput-slug';
    public const COMPONENT_FILTERINPUT_DATEFORMAT = 'filterinput-date-format';
    public const COMPONENT_FILTERINPUT_GMT = 'filterinput-date-gmt';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SortFilterInput|null
     */
    private $sortFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeIDsFilterInput|null
     */
    private $excludeIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeParentIDsFilterInput|null
     */
    private $excludeParentIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\FormatFilterInput|null
     */
    private $formatFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\GMTFilterInput|null
     */
    private $gmtFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput|null
     */
    private $includeFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\LimitFilterInput|null
     */
    private $limitFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\OffsetFilterInput|null
     */
    private $offsetFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput|null
     */
    private $parentIDFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDsFilterInput|null
     */
    private $parentIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput|null
     */
    private $searchFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput|null
     */
    private $slugFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput|null
     */
    private $slugsFilterInput;
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
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
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
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
    protected final function getSortFilterInput() : SortFilterInput
    {
        if ($this->sortFilterInput === null) {
            /** @var SortFilterInput */
            $sortFilterInput = $this->instanceManager->getInstance(SortFilterInput::class);
            $this->sortFilterInput = $sortFilterInput;
        }
        return $this->sortFilterInput;
    }
    protected final function getExcludeIDsFilterInput() : ExcludeIDsFilterInput
    {
        if ($this->excludeIDsFilterInput === null) {
            /** @var ExcludeIDsFilterInput */
            $excludeIDsFilterInput = $this->instanceManager->getInstance(ExcludeIDsFilterInput::class);
            $this->excludeIDsFilterInput = $excludeIDsFilterInput;
        }
        return $this->excludeIDsFilterInput;
    }
    protected final function getExcludeParentIDsFilterInput() : ExcludeParentIDsFilterInput
    {
        if ($this->excludeParentIDsFilterInput === null) {
            /** @var ExcludeParentIDsFilterInput */
            $excludeParentIDsFilterInput = $this->instanceManager->getInstance(ExcludeParentIDsFilterInput::class);
            $this->excludeParentIDsFilterInput = $excludeParentIDsFilterInput;
        }
        return $this->excludeParentIDsFilterInput;
    }
    protected final function getFormatFilterInput() : FormatFilterInput
    {
        if ($this->formatFilterInput === null) {
            /** @var FormatFilterInput */
            $formatFilterInput = $this->instanceManager->getInstance(FormatFilterInput::class);
            $this->formatFilterInput = $formatFilterInput;
        }
        return $this->formatFilterInput;
    }
    protected final function getGMTFilterInput() : GMTFilterInput
    {
        if ($this->gmtFilterInput === null) {
            /** @var GMTFilterInput */
            $gmtFilterInput = $this->instanceManager->getInstance(GMTFilterInput::class);
            $this->gmtFilterInput = $gmtFilterInput;
        }
        return $this->gmtFilterInput;
    }
    protected final function getIncludeFilterInput() : IncludeFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var IncludeFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(IncludeFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    protected final function getLimitFilterInput() : LimitFilterInput
    {
        if ($this->limitFilterInput === null) {
            /** @var LimitFilterInput */
            $limitFilterInput = $this->instanceManager->getInstance(LimitFilterInput::class);
            $this->limitFilterInput = $limitFilterInput;
        }
        return $this->limitFilterInput;
    }
    protected final function getOffsetFilterInput() : OffsetFilterInput
    {
        if ($this->offsetFilterInput === null) {
            /** @var OffsetFilterInput */
            $offsetFilterInput = $this->instanceManager->getInstance(OffsetFilterInput::class);
            $this->offsetFilterInput = $offsetFilterInput;
        }
        return $this->offsetFilterInput;
    }
    protected final function getParentIDFilterInput() : ParentIDFilterInput
    {
        if ($this->parentIDFilterInput === null) {
            /** @var ParentIDFilterInput */
            $parentIDFilterInput = $this->instanceManager->getInstance(ParentIDFilterInput::class);
            $this->parentIDFilterInput = $parentIDFilterInput;
        }
        return $this->parentIDFilterInput;
    }
    protected final function getParentIDsFilterInput() : ParentIDsFilterInput
    {
        if ($this->parentIDsFilterInput === null) {
            /** @var ParentIDsFilterInput */
            $parentIDsFilterInput = $this->instanceManager->getInstance(ParentIDsFilterInput::class);
            $this->parentIDsFilterInput = $parentIDsFilterInput;
        }
        return $this->parentIDsFilterInput;
    }
    protected final function getSearchFilterInput() : SearchFilterInput
    {
        if ($this->searchFilterInput === null) {
            /** @var SearchFilterInput */
            $searchFilterInput = $this->instanceManager->getInstance(SearchFilterInput::class);
            $this->searchFilterInput = $searchFilterInput;
        }
        return $this->searchFilterInput;
    }
    protected final function getSlugFilterInput() : SlugFilterInput
    {
        if ($this->slugFilterInput === null) {
            /** @var SlugFilterInput */
            $slugFilterInput = $this->instanceManager->getInstance(SlugFilterInput::class);
            $this->slugFilterInput = $slugFilterInput;
        }
        return $this->slugFilterInput;
    }
    protected final function getSlugsFilterInput() : SlugsFilterInput
    {
        if ($this->slugsFilterInput === null) {
            /** @var SlugsFilterInput */
            $slugsFilterInput = $this->instanceManager->getInstance(SlugsFilterInput::class);
            $this->slugsFilterInput = $slugsFilterInput;
        }
        return $this->slugsFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_SORT, self::COMPONENT_FILTERINPUT_LIMIT, self::COMPONENT_FILTERINPUT_OFFSET, self::COMPONENT_FILTERINPUT_SEARCH, self::COMPONENT_FILTERINPUT_IDS, self::COMPONENT_FILTERINPUT_ID, self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS, self::COMPONENT_FILTERINPUT_EXCLUDE_IDS, self::COMPONENT_FILTERINPUT_PARENT_IDS, self::COMPONENT_FILTERINPUT_PARENT_ID, self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS, self::COMPONENT_FILTERINPUT_SLUGS, self::COMPONENT_FILTERINPUT_SLUG, self::COMPONENT_FILTERINPUT_DATEFORMAT, self::COMPONENT_FILTERINPUT_GMT);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_SORT:
                return $this->getSortFilterInput();
            case self::COMPONENT_FILTERINPUT_LIMIT:
                return $this->getLimitFilterInput();
            case self::COMPONENT_FILTERINPUT_OFFSET:
                return $this->getOffsetFilterInput();
            case self::COMPONENT_FILTERINPUT_SEARCH:
                return $this->getSearchFilterInput();
            case self::COMPONENT_FILTERINPUT_IDS:
                return $this->getIncludeFilterInput();
            case self::COMPONENT_FILTERINPUT_ID:
                return $this->getIncludeFilterInput();
            case self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS:
                return $this->getIncludeFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
                return $this->getExcludeIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
                return $this->getParentIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_PARENT_ID:
                return $this->getParentIDFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
                return $this->getExcludeParentIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return $this->getSlugsFilterInput();
            case self::COMPONENT_FILTERINPUT_SLUG:
                return $this->getSlugFilterInput();
            case self::COMPONENT_FILTERINPUT_DATEFORMAT:
                return $this->getFormatFilterInput();
            case self::COMPONENT_FILTERINPUT_GMT:
                return $this->getGMTFilterInput();
            default:
                return null;
        }
    }
    public function getInputClass(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_SORT:
                return OrderFormInput::class;
            case self::COMPONENT_FILTERINPUT_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return FormMultipleInput::class;
            case self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS:
                return MultiValueFromStringFormInput::class;
            case self::COMPONENT_FILTERINPUT_GMT:
                return BooleanFormInput::class;
        }
        return parent::getInputClass($component);
    }
    public function getName(Component $component) : string
    {
        switch ((string) $component->name) {
            case self::COMPONENT_FILTERINPUT_SORT:
                return 'order';
            case self::COMPONENT_FILTERINPUT_LIMIT:
                return 'limit';
            case self::COMPONENT_FILTERINPUT_OFFSET:
                return 'offset';
            case self::COMPONENT_FILTERINPUT_SEARCH:
                return 'searchfor';
            case self::COMPONENT_FILTERINPUT_IDS:
                return 'ids';
            case self::COMPONENT_FILTERINPUT_ID:
                return 'id';
            case self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS:
                return 'id';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
                return 'excludeIDs';
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
                return 'parentIDs';
            case self::COMPONENT_FILTERINPUT_PARENT_ID:
                return 'parentID';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
                return 'excludeParentIDs';
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return 'slugs';
            case self::COMPONENT_FILTERINPUT_SLUG:
                return 'slug';
            case self::COMPONENT_FILTERINPUT_DATEFORMAT:
                return 'format';
            case self::COMPONENT_FILTERINPUT_GMT:
                return 'gmt';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ((string) $component->name) {
            case self::COMPONENT_FILTERINPUT_SORT:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_LIMIT:
                return $this->getIntScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_OFFSET:
                return $this->getIntScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_SEARCH:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_ID:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_PARENT_ID:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_SLUG:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_DATEFORMAT:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_GMT:
                return $this->getBooleanScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ((string) $component->name) {
            case self::COMPONENT_FILTERINPUT_SORT:
                return $this->__('Order the results. Specify the \'orderby\' and \'order\' (\'ASC\' or \'DESC\') fields in this format: \'orderby|order\'', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_LIMIT:
                return $this->__('Limit the results. \'-1\' brings all the results (or the maximum amount allowed)', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_OFFSET:
                return $this->__('Offset the results by how many positions', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_SEARCH:
                return $this->__('Search for elements containing the given string', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_IDS:
                return $this->__('Limit results to elements with the given IDs', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_ID:
                return $this->__('Fetch the element with the given ID', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_COMMASEPARATED_IDS:
                return \sprintf($this->__('Limit results to elements with the given ID, or IDs (separated by \'%s\')', 'schema-commons'), Param::VALUE_SEPARATOR);
            case self::COMPONENT_FILTERINPUT_EXCLUDE_IDS:
                return $this->__('Exclude elements with the given IDs', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_PARENT_IDS:
                return $this->__('Limit results to elements with the given parent IDs. \'0\' means \'no parent\'', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_PARENT_ID:
                return $this->__('Limit results to elements with the given parent ID. \'0\' means \'no parent\'', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_EXCLUDE_PARENT_IDS:
                return $this->__('Exclude elements with the given parent IDs', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return $this->__('Limit results to elements with the given slug', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_SLUGS:
                return $this->__('Limit results to elements with the given slug', 'schema-commons');
            case self::COMPONENT_FILTERINPUT_DATEFORMAT:
                return \sprintf($this->__('Date format, as defined in %s', 'schema-commons'), 'https://www.php.net/manual/en/function.date.php');
            case self::COMPONENT_FILTERINPUT_GMT:
                return $this->__('Whether to retrieve the date as UTC or GMT timezone', 'schema-commons');
            default:
                return null;
        }
    }
}
