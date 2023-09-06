<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\TypeResolvers\InputObjectType;

use PoPCMSSchema\Comments\Constants\CommentStatus;
use PoPCMSSchema\Comments\Constants\CommentTypes;
use PoPCMSSchema\Comments\FilterInputs\CommentStatusFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CommentTypesFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostIDFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostIDsFilterInput;
use PoPCMSSchema\Comments\FilterInputs\CustomPostStatusFilterInput;
use PoPCMSSchema\Comments\FilterInputs\ExcludeCustomPostIDsFilterInput;
use PoPCMSSchema\Comments\Module;
use PoPCMSSchema\Comments\ModuleConfiguration;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver;
use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\Module as CustomPostsModule;
use PoPCMSSchema\CustomPosts\ModuleConfiguration as CustomPostsModuleConfiguration;
use PoPCMSSchema\CustomPosts\FilterInputs\UnionCustomPostTypesFilterInput;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeParentIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\AbstractObjectsFilterInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\DateQueryInputObjectTypeResolver;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Root\App;
abstract class AbstractCommentsFilterInputObjectTypeResolver extends AbstractObjectsFilterInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\DateQueryInputObjectTypeResolver|null
     */
    private $dateQueryInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver|null
     */
    private $commentStatusEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver|null
     */
    private $customPostStatusEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentTypeEnumTypeResolver|null
     */
    private $commentTypeEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver|null
     */
    private $customPostEnumStringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
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
    /**
     * @var \PoPCMSSchema\CustomPosts\FilterInputs\UnionCustomPostTypesFilterInput|null
     */
    private $unionCustomPostTypesFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput|null
     */
    private $searchFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput|null
     */
    private $parentIDFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDsFilterInput|null
     */
    private $parentIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeParentIDsFilterInput|null
     */
    private $excludeParentIDsFilterInput;
    public final function setDateQueryInputObjectTypeResolver(DateQueryInputObjectTypeResolver $dateQueryInputObjectTypeResolver) : void
    {
        $this->dateQueryInputObjectTypeResolver = $dateQueryInputObjectTypeResolver;
    }
    protected final function getDateQueryInputObjectTypeResolver() : DateQueryInputObjectTypeResolver
    {
        if ($this->dateQueryInputObjectTypeResolver === null) {
            /** @var DateQueryInputObjectTypeResolver */
            $dateQueryInputObjectTypeResolver = $this->instanceManager->getInstance(DateQueryInputObjectTypeResolver::class);
            $this->dateQueryInputObjectTypeResolver = $dateQueryInputObjectTypeResolver;
        }
        return $this->dateQueryInputObjectTypeResolver;
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
    public final function setCustomPostEnumStringScalarTypeResolver(CustomPostEnumStringScalarTypeResolver $customPostEnumStringScalarTypeResolver) : void
    {
        $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
    }
    protected final function getCustomPostEnumStringScalarTypeResolver() : CustomPostEnumStringScalarTypeResolver
    {
        if ($this->customPostEnumStringScalarTypeResolver === null) {
            /** @var CustomPostEnumStringScalarTypeResolver */
            $customPostEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CustomPostEnumStringScalarTypeResolver::class);
            $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
        }
        return $this->customPostEnumStringScalarTypeResolver;
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
    public final function setUnionCustomPostTypesFilterInput(UnionCustomPostTypesFilterInput $unionCustomPostTypesFilterInput) : void
    {
        $this->unionCustomPostTypesFilterInput = $unionCustomPostTypesFilterInput;
    }
    protected final function getUnionCustomPostTypesFilterInput() : UnionCustomPostTypesFilterInput
    {
        if ($this->unionCustomPostTypesFilterInput === null) {
            /** @var UnionCustomPostTypesFilterInput */
            $unionCustomPostTypesFilterInput = $this->instanceManager->getInstance(UnionCustomPostTypesFilterInput::class);
            $this->unionCustomPostTypesFilterInput = $unionCustomPostTypesFilterInput;
        }
        return $this->unionCustomPostTypesFilterInput;
    }
    public final function setExcludeParentIDsFilterInput(ExcludeParentIDsFilterInput $excludeParentIDsFilterInput) : void
    {
        $this->excludeParentIDsFilterInput = $excludeParentIDsFilterInput;
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
    public final function setSearchFilterInput(SearchFilterInput $searchFilterInput) : void
    {
        $this->searchFilterInput = $searchFilterInput;
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
    public final function setParentIDFilterInput(ParentIDFilterInput $parentIDFilterInput) : void
    {
        $this->parentIDFilterInput = $parentIDFilterInput;
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
    public final function setParentIDsFilterInput(ParentIDsFilterInput $parentIDsFilterInput) : void
    {
        $this->parentIDsFilterInput = $parentIDsFilterInput;
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
    /**
     * @return string[]
     */
    public function getSensitiveInputFieldNames() : array
    {
        $sensitiveInputFieldNames = parent::getSensitiveInputFieldNames();
        if ($this->treatCommentStatusAsSensitiveData()) {
            $sensitiveInputFieldNames[] = 'status';
        }
        if ($this->treatCustomPostStatusAsSensitiveData()) {
            $sensitiveInputFieldNames[] = 'customPostStatus';
        }
        return $sensitiveInputFieldNames;
    }
    protected function treatCommentStatusAsSensitiveData() : bool
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return $moduleConfiguration->treatCommentStatusAsSensitiveData();
    }
    protected function treatCustomPostStatusAsSensitiveData() : bool
    {
        /** @var CustomPostsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostsModule::class)->getConfiguration();
        return $moduleConfiguration->treatCustomPostStatusAsSensitiveData();
    }
    protected abstract function addParentInputFields() : bool;
    protected abstract function addCustomPostInputFields() : bool;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['status' => $this->getCommentStatusEnumTypeResolver(), 'search' => $this->getStringScalarTypeResolver(), 'dateQuery' => $this->getDateQueryInputObjectTypeResolver(), 'types' => $this->getCommentTypeEnumTypeResolver()], $this->addParentInputFields() ? ['parentID' => $this->getIDScalarTypeResolver(), 'parentIDs' => $this->getIDScalarTypeResolver(), 'excludeParentIDs' => $this->getIDScalarTypeResolver()] : [], $this->addCustomPostInputFields() ? ['customPostID' => $this->getIDScalarTypeResolver(), 'customPostIDs' => $this->getIDScalarTypeResolver(), 'excludeCustomPostIDs' => $this->getIDScalarTypeResolver(), 'customPostStatus' => $this->getCustomPostStatusEnumTypeResolver(), 'customPostTypes' => $this->getCustomPostEnumStringScalarTypeResolver()] : []);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'status':
                return $this->__('Comment status', 'comments');
            case 'search':
                return $this->__('Search for comments containing the given string', 'comments');
            case 'dateQuery':
                return $this->__('Filter comments based on date', 'comments');
            case 'types':
                return $this->__('Filter comments based on type', 'comments');
            case 'parentID':
                return $this->__('Filter comments with the given parent IDs. \'0\' means \'no parent\'', 'comments');
            case 'parentIDs':
                return $this->__('Filter comments with the given parent ID. \'0\' means \'no parent\'', 'comments');
            case 'excludeParentIDs':
                return $this->__('Exclude comments with the given parent IDs', 'comments');
            case 'customPostID':
                return $this->__('Filter comments added to the given custom post', 'comments');
            case 'customPostIDs':
                return $this->__('Filter comments added to the given custom posts', 'comments');
            case 'excludeCustomPostIDs':
                return $this->__('Exclude comments added to the given custom posts', 'comments');
            case 'customPostStatus':
                return $this->__('Filter comments added to the custom posts with given status', 'comments');
            case 'customPostTypes':
                return $this->__('Filter comments added to custom posts of given types', 'comments');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'status':
                return [CommentStatus::APPROVE];
            case 'types':
                return [CommentTypes::COMMENT];
            case 'customPostStatus':
                return [CustomPostStatus::PUBLISH];
            case 'customPostTypes':
                return $this->getCustomPostEnumStringScalarTypeResolver()->getConsolidatedPossibleValues();
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'status':
            case 'types':
            case 'parentIDs':
            case 'excludeParentIDs':
            case 'customPostIDs':
            case 'excludeCustomPostIDs':
            case 'customPostStatus':
            case 'customPostTypes':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'status':
                return $this->getCommentStatusFilterInput();
            case 'search':
                return $this->getSearchFilterInput();
            case 'types':
                return $this->getCommentTypesFilterInput();
            case 'parentID':
                return $this->getParentIDFilterInput();
            case 'parentIDs':
                return $this->getParentIDsFilterInput();
            case 'excludeParentIDs':
                return $this->getExcludeParentIDsFilterInput();
            case 'customPostID':
                return $this->getCustomPostIDFilterInput();
            case 'customPostIDs':
                return $this->getCustomPostIDsFilterInput();
            case 'excludeCustomPostIDs':
                return $this->getExcludeCustomPostIDsFilterInput();
            case 'customPostStatus':
                return $this->getCustomPostStatusFilterInput();
            case 'customPostTypes':
                return $this->getUnionCustomPostTypesFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
