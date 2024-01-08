<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\AuthorIDsFilterInput;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\AuthorSlugFilterInput;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\ExcludeAuthorIDsFilterInput;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_AUTHOR_IDS = 'filterinput-author-ids';
    public const COMPONENT_FILTERINPUT_AUTHOR_SLUG = 'filterinput-author-slug';
    public const COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS = 'filterinput-exclude-author-ids';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\AuthorIDsFilterInput|null
     */
    private $authorIDsFilterInput;
    /**
     * @var \PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\AuthorSlugFilterInput|null
     */
    private $authorSlugFilterInput;
    /**
     * @var \PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FilterInputs\ExcludeAuthorIDsFilterInput|null
     */
    private $excludeAuthorIDsFilterInput;
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
    public final function setAuthorIDsFilterInput(AuthorIDsFilterInput $authorIDsFilterInput) : void
    {
        $this->authorIDsFilterInput = $authorIDsFilterInput;
    }
    protected final function getAuthorIDsFilterInput() : AuthorIDsFilterInput
    {
        if ($this->authorIDsFilterInput === null) {
            /** @var AuthorIDsFilterInput */
            $authorIDsFilterInput = $this->instanceManager->getInstance(AuthorIDsFilterInput::class);
            $this->authorIDsFilterInput = $authorIDsFilterInput;
        }
        return $this->authorIDsFilterInput;
    }
    public final function setAuthorSlugFilterInput(AuthorSlugFilterInput $authorSlugFilterInput) : void
    {
        $this->authorSlugFilterInput = $authorSlugFilterInput;
    }
    protected final function getAuthorSlugFilterInput() : AuthorSlugFilterInput
    {
        if ($this->authorSlugFilterInput === null) {
            /** @var AuthorSlugFilterInput */
            $authorSlugFilterInput = $this->instanceManager->getInstance(AuthorSlugFilterInput::class);
            $this->authorSlugFilterInput = $authorSlugFilterInput;
        }
        return $this->authorSlugFilterInput;
    }
    public final function setExcludeAuthorIDsFilterInput(ExcludeAuthorIDsFilterInput $excludeAuthorIDsFilterInput) : void
    {
        $this->excludeAuthorIDsFilterInput = $excludeAuthorIDsFilterInput;
    }
    protected final function getExcludeAuthorIDsFilterInput() : ExcludeAuthorIDsFilterInput
    {
        if ($this->excludeAuthorIDsFilterInput === null) {
            /** @var ExcludeAuthorIDsFilterInput */
            $excludeAuthorIDsFilterInput = $this->instanceManager->getInstance(ExcludeAuthorIDsFilterInput::class);
            $this->excludeAuthorIDsFilterInput = $excludeAuthorIDsFilterInput;
        }
        return $this->excludeAuthorIDsFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_AUTHOR_IDS, self::COMPONENT_FILTERINPUT_AUTHOR_SLUG, self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_AUTHOR_IDS:
                return $this->getAuthorIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_AUTHOR_SLUG:
                return $this->getAuthorSlugFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS:
                return $this->getExcludeAuthorIDsFilterInput();
            default:
                return null;
        }
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_AUTHOR_IDS:
                return 'authorIDs';
            case self::COMPONENT_FILTERINPUT_AUTHOR_SLUG:
                return 'authorSlug';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS:
                return 'excludeAuthorIDs';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_AUTHOR_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_AUTHOR_SLUG:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS:
                return $this->getIDScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_AUTHOR_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_AUTHOR_IDS:
                return $this->__('Get results from the authors with given IDs', 'pop-users');
            case self::COMPONENT_FILTERINPUT_AUTHOR_SLUG:
                return $this->__('Get results from the authors with given slug', 'pop-users');
            case self::COMPONENT_FILTERINPUT_EXCLUDE_AUTHOR_IDS:
                return $this->__('Get results excluding the ones from authors with given IDs', 'pop-users');
            default:
                return null;
        }
    }
}
