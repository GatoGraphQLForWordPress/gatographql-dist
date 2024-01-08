<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\ComponentProcessors\FormInputs;

use PoPCMSSchema\Comments\Constants\CommentStatus;
use PoPCMSSchema\Comments\Constants\CommentTypes;
use PoPCMSSchema\Comments\FilterInputs\CommentStatusFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CommentTypesFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostIDFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostIDsFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostStatusFilterInput;
use PoPCMSSchema\Comments\FilterInputs\ExcludeCustomPostIDsFilterInput;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver;
use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\FormInputs\FormMultipleInput;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_CUSTOMPOST_IDS = 'filterinput-custompost-ids';
    public const COMPONENT_FILTERINPUT_CUSTOMPOST_ID = 'filterinput-custompost-id';
    public const COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS = 'filterinput-custompost-status';
    public const COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS = 'filterinput-exclude-custompost-ids';
    public const COMPONENT_FILTERINPUT_COMMENT_TYPES = 'filterinput-comment-types';
    public const COMPONENT_FILTERINPUT_COMMENT_STATUS = 'filterinput-comment-status';
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver|null
     */
    private $commentTypeEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver|null
     */
    private $commentStatusEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver|null
     */
    private $customPostStatusEnumTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\CommentStatusFilterInput|null
     */
    private $commentStatusFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\CommentTypesFilterInput|null
     */
    private $commentTypesFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\CustomPostIDFilterInput|null
     */
    private $customPostIDFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\CustomPostIDsFilterInput|null
     */
    private $customPostIDsFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\CustomPostStatusFilterInput|null
     */
    private $customPostStatusFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\FilterInputs\ExcludeCustomPostIDsFilterInput|null
     */
    private $excludeCustomPostIDsFilterInput;
    public final function setCommentTypeEnumTypeResolver(CommentTypeEnumTypeResolver $commentTypeEnumTypeResolver) : void
    {
        $this->commentTypeEnumTypeResolver = $commentTypeEnumTypeResolver;
    }
    protected final function getCommentTypeEnumTypeResolver() : CommentTypeEnumTypeResolver
    {
        if ($this->commentTypeEnumTypeResolver === null) {
            /** @var CommentTypeEnumTypeResolver */
            $commentTypeEnumTypeResolver = $this->instanceManager->getInstance(CommentTypeEnumTypeResolver::class);
            $this->commentTypeEnumTypeResolver = $commentTypeEnumTypeResolver;
        }
        return $this->commentTypeEnumTypeResolver;
    }
    public final function setCommentStatusEnumTypeResolver(CommentStatusEnumTypeResolver $commentStatusEnumTypeResolver) : void
    {
        $this->commentStatusEnumTypeResolver = $commentStatusEnumTypeResolver;
    }
    protected final function getCommentStatusEnumTypeResolver() : CommentStatusEnumTypeResolver
    {
        if ($this->commentStatusEnumTypeResolver === null) {
            /** @var CommentStatusEnumTypeResolver */
            $commentStatusEnumTypeResolver = $this->instanceManager->getInstance(CommentStatusEnumTypeResolver::class);
            $this->commentStatusEnumTypeResolver = $commentStatusEnumTypeResolver;
        }
        return $this->commentStatusEnumTypeResolver;
    }
    public final function setCustomPostStatusEnumTypeResolver(CustomPostStatusEnumTypeResolver $customPostStatusEnumTypeResolver) : void
    {
        $this->customPostStatusEnumTypeResolver = $customPostStatusEnumTypeResolver;
    }
    protected final function getCustomPostStatusEnumTypeResolver() : CustomPostStatusEnumTypeResolver
    {
        if ($this->customPostStatusEnumTypeResolver === null) {
            /** @var CustomPostStatusEnumTypeResolver */
            $customPostStatusEnumTypeResolver = $this->instanceManager->getInstance(CustomPostStatusEnumTypeResolver::class);
            $this->customPostStatusEnumTypeResolver = $customPostStatusEnumTypeResolver;
        }
        return $this->customPostStatusEnumTypeResolver;
    }
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
    public final function setCommentStatusFilterInput(CommentStatusFilterInput $commentStatusFilterInput) : void
    {
        $this->commentStatusFilterInput = $commentStatusFilterInput;
    }
    protected final function getCommentStatusFilterInput() : CommentStatusFilterInput
    {
        if ($this->commentStatusFilterInput === null) {
            /** @var CommentStatusFilterInput */
            $commentStatusFilterInput = $this->instanceManager->getInstance(CommentStatusFilterInput::class);
            $this->commentStatusFilterInput = $commentStatusFilterInput;
        }
        return $this->commentStatusFilterInput;
    }
    public final function setCommentTypesFilterInput(CommentTypesFilterInput $commentTypesFilterInput) : void
    {
        $this->commentTypesFilterInput = $commentTypesFilterInput;
    }
    protected final function getCommentTypesFilterInput() : CommentTypesFilterInput
    {
        if ($this->commentTypesFilterInput === null) {
            /** @var CommentTypesFilterInput */
            $commentTypesFilterInput = $this->instanceManager->getInstance(CommentTypesFilterInput::class);
            $this->commentTypesFilterInput = $commentTypesFilterInput;
        }
        return $this->commentTypesFilterInput;
    }
    public final function setCustomPostIDFilterInput(CustomPostIDFilterInput $customPostIDFilterInput) : void
    {
        $this->customPostIDFilterInput = $customPostIDFilterInput;
    }
    protected final function getCustomPostIDFilterInput() : CustomPostIDFilterInput
    {
        if ($this->customPostIDFilterInput === null) {
            /** @var CustomPostIDFilterInput */
            $customPostIDFilterInput = $this->instanceManager->getInstance(CustomPostIDFilterInput::class);
            $this->customPostIDFilterInput = $customPostIDFilterInput;
        }
        return $this->customPostIDFilterInput;
    }
    public final function setCustomPostIDsFilterInput(CustomPostIDsFilterInput $customPostIDsFilterInput) : void
    {
        $this->customPostIDsFilterInput = $customPostIDsFilterInput;
    }
    protected final function getCustomPostIDsFilterInput() : CustomPostIDsFilterInput
    {
        if ($this->customPostIDsFilterInput === null) {
            /** @var CustomPostIDsFilterInput */
            $customPostIDsFilterInput = $this->instanceManager->getInstance(CustomPostIDsFilterInput::class);
            $this->customPostIDsFilterInput = $customPostIDsFilterInput;
        }
        return $this->customPostIDsFilterInput;
    }
    public final function setCustomPostStatusFilterInput(CustomPostStatusFilterInput $customPostStatusFilterInput) : void
    {
        $this->customPostStatusFilterInput = $customPostStatusFilterInput;
    }
    protected final function getCustomPostStatusFilterInput() : CustomPostStatusFilterInput
    {
        if ($this->customPostStatusFilterInput === null) {
            /** @var CustomPostStatusFilterInput */
            $customPostStatusFilterInput = $this->instanceManager->getInstance(CustomPostStatusFilterInput::class);
            $this->customPostStatusFilterInput = $customPostStatusFilterInput;
        }
        return $this->customPostStatusFilterInput;
    }
    public final function setExcludeCustomPostIDsFilterInput(ExcludeCustomPostIDsFilterInput $excludeCustomPostIDsFilterInput) : void
    {
        $this->excludeCustomPostIDsFilterInput = $excludeCustomPostIDsFilterInput;
    }
    protected final function getExcludeCustomPostIDsFilterInput() : ExcludeCustomPostIDsFilterInput
    {
        if ($this->excludeCustomPostIDsFilterInput === null) {
            /** @var ExcludeCustomPostIDsFilterInput */
            $excludeCustomPostIDsFilterInput = $this->instanceManager->getInstance(ExcludeCustomPostIDsFilterInput::class);
            $this->excludeCustomPostIDsFilterInput = $excludeCustomPostIDsFilterInput;
        }
        return $this->excludeCustomPostIDsFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS, self::COMPONENT_FILTERINPUT_CUSTOMPOST_ID, self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS, self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS, self::COMPONENT_FILTERINPUT_COMMENT_TYPES, self::COMPONENT_FILTERINPUT_COMMENT_STATUS);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
                return $this->getCustomPostIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_ID:
                return $this->getCustomPostIDFilterInput();
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
                return $this->getCustomPostStatusFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
                return $this->getExcludeCustomPostIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
                return $this->getCommentTypesFilterInput();
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return $this->getCommentStatusFilterInput();
            default:
                return null;
        }
    }
    public function getInputClass(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return FormMultipleInput::class;
        }
        return parent::getInputClass($component);
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
                return 'customPostIDs';
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_ID:
                return 'customPostID';
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
                return 'customPostStatus';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
                return 'excludeCustomPostIDs';
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
                return 'types';
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return 'status';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_ID:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
                return $this->getCustomPostStatusEnumTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
                return $this->getCommentTypeEnumTypeResolver();
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return $this->getCommentStatusEnumTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    /**
     * @return mixed
     */
    public function getFilterInputDefaultValue(Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
                return [CustomPostStatus::PUBLISH];
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
                return [CommentTypes::COMMENT];
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return [CommentStatus::APPROVE];
            default:
                return null;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_IDS:
                return $this->__('Limit results to elements with the given custom post IDs', 'comments');
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_ID:
                return $this->__('Limit results to elements with the given custom post ID', 'comments');
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_STATUS:
                return $this->__('Limit results to elements with the given custom post status', 'comments');
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_IDS:
                return $this->__('Exclude elements with the given custom post IDs', 'comments');
            case self::COMPONENT_FILTERINPUT_COMMENT_TYPES:
                return $this->__('Types of comment', 'comments');
            case self::COMPONENT_FILTERINPUT_COMMENT_STATUS:
                return $this->__('Status of the comment', 'comments');
            default:
                return null;
        }
    }
}
