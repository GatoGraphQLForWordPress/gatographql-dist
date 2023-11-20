<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPosts\ComponentProcessors\CommonCustomPostFilterInputContainerComponentProcessor;
use PoPCMSSchema\CustomPosts\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoPCMSSchema\CustomPosts\Module;
use PoPCMSSchema\CustomPosts\ModuleConfiguration;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver;
use PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface;
use PoPCMSSchema\Pages\TypeResolvers\InputObjectType\PageByOneofInputObjectTypeResolver;
use PoPCMSSchema\Pages\TypeResolvers\InputObjectType\PagePaginationInputObjectTypeResolver;
use PoPCMSSchema\Pages\TypeResolvers\InputObjectType\RootPagesFilterInputObjectTypeResolver;
use PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\FilterInput\FilterInputHelper;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class RootPageObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\ObjectType\PageObjectTypeResolver|null
     */
    private $pageObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Pages\TypeAPIs\PageTypeAPIInterface|null
     */
    private $pageTypeAPI;
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\InputObjectType\PageByOneofInputObjectTypeResolver|null
     */
    private $pageByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\InputObjectType\RootPagesFilterInputObjectTypeResolver|null
     */
    private $rootPagesFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Pages\TypeResolvers\InputObjectType\PagePaginationInputObjectTypeResolver|null
     */
    private $pagePaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver|null
     */
    private $customPostSortInputObjectTypeResolver;
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
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
    public final function setPageObjectTypeResolver(PageObjectTypeResolver $pageObjectTypeResolver) : void
    {
        $this->pageObjectTypeResolver = $pageObjectTypeResolver;
    }
    protected final function getPageObjectTypeResolver() : PageObjectTypeResolver
    {
        if ($this->pageObjectTypeResolver === null) {
            /** @var PageObjectTypeResolver */
            $pageObjectTypeResolver = $this->instanceManager->getInstance(PageObjectTypeResolver::class);
            $this->pageObjectTypeResolver = $pageObjectTypeResolver;
        }
        return $this->pageObjectTypeResolver;
    }
    public final function setPageTypeAPI(PageTypeAPIInterface $pageTypeAPI) : void
    {
        $this->pageTypeAPI = $pageTypeAPI;
    }
    protected final function getPageTypeAPI() : PageTypeAPIInterface
    {
        if ($this->pageTypeAPI === null) {
            /** @var PageTypeAPIInterface */
            $pageTypeAPI = $this->instanceManager->getInstance(PageTypeAPIInterface::class);
            $this->pageTypeAPI = $pageTypeAPI;
        }
        return $this->pageTypeAPI;
    }
    public final function setPageByOneofInputObjectTypeResolver(PageByOneofInputObjectTypeResolver $pageByOneofInputObjectTypeResolver) : void
    {
        $this->pageByOneofInputObjectTypeResolver = $pageByOneofInputObjectTypeResolver;
    }
    protected final function getPageByOneofInputObjectTypeResolver() : PageByOneofInputObjectTypeResolver
    {
        if ($this->pageByOneofInputObjectTypeResolver === null) {
            /** @var PageByOneofInputObjectTypeResolver */
            $pageByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(PageByOneofInputObjectTypeResolver::class);
            $this->pageByOneofInputObjectTypeResolver = $pageByOneofInputObjectTypeResolver;
        }
        return $this->pageByOneofInputObjectTypeResolver;
    }
    public final function setRootPagesFilterInputObjectTypeResolver(RootPagesFilterInputObjectTypeResolver $rootPagesFilterInputObjectTypeResolver) : void
    {
        $this->rootPagesFilterInputObjectTypeResolver = $rootPagesFilterInputObjectTypeResolver;
    }
    protected final function getRootPagesFilterInputObjectTypeResolver() : RootPagesFilterInputObjectTypeResolver
    {
        if ($this->rootPagesFilterInputObjectTypeResolver === null) {
            /** @var RootPagesFilterInputObjectTypeResolver */
            $rootPagesFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootPagesFilterInputObjectTypeResolver::class);
            $this->rootPagesFilterInputObjectTypeResolver = $rootPagesFilterInputObjectTypeResolver;
        }
        return $this->rootPagesFilterInputObjectTypeResolver;
    }
    public final function setPagePaginationInputObjectTypeResolver(PagePaginationInputObjectTypeResolver $pagePaginationInputObjectTypeResolver) : void
    {
        $this->pagePaginationInputObjectTypeResolver = $pagePaginationInputObjectTypeResolver;
    }
    protected final function getPagePaginationInputObjectTypeResolver() : PagePaginationInputObjectTypeResolver
    {
        if ($this->pagePaginationInputObjectTypeResolver === null) {
            /** @var PagePaginationInputObjectTypeResolver */
            $pagePaginationInputObjectTypeResolver = $this->instanceManager->getInstance(PagePaginationInputObjectTypeResolver::class);
            $this->pagePaginationInputObjectTypeResolver = $pagePaginationInputObjectTypeResolver;
        }
        return $this->pagePaginationInputObjectTypeResolver;
    }
    public final function setCustomPostSortInputObjectTypeResolver(CustomPostSortInputObjectTypeResolver $customPostSortInputObjectTypeResolver) : void
    {
        $this->customPostSortInputObjectTypeResolver = $customPostSortInputObjectTypeResolver;
    }
    protected final function getCustomPostSortInputObjectTypeResolver() : CustomPostSortInputObjectTypeResolver
    {
        if ($this->customPostSortInputObjectTypeResolver === null) {
            /** @var CustomPostSortInputObjectTypeResolver */
            $customPostSortInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostSortInputObjectTypeResolver::class);
            $this->customPostSortInputObjectTypeResolver = $customPostSortInputObjectTypeResolver;
        }
        return $this->customPostSortInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['page', 'pages', 'pageCount'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'page':
                return $this->__('Retrieve a single page', 'pages');
            case 'pages':
                return $this->__('Pages', 'pages');
            case 'pageCount':
                return $this->__('Number of pages', 'pages');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'page':
            case 'pages':
                return $this->getPageObjectTypeResolver();
            case 'pageCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'pageCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'pages':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component
    {
        switch ($fieldName) {
            case 'page':
                return new Component(CommonCustomPostFilterInputContainerComponentProcessor::class, CommonCustomPostFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_CUSTOMPOSTSTATUS);
            default:
                return parent::getFieldFilterInputContainerComponent($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'page':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getPageByOneofInputObjectTypeResolver()]);
            case 'pages':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootPagesFilterInputObjectTypeResolver(), 'pagination' => $this->getPagePaginationInputObjectTypeResolver(), 'sort' => $this->getCustomPostSortInputObjectTypeResolver()]);
            case 'pageCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootPagesFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    /**
     * @return string[]
     */
    public function getSensitiveFieldArgNames(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $sensitiveFieldArgNames = parent::getSensitiveFieldArgNames($objectTypeResolver, $fieldName);
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        switch ($fieldName) {
            case 'page':
                if ($moduleConfiguration->treatCustomPostStatusAsSensitiveData()) {
                    $customPostStatusFilterInputName = FilterInputHelper::getFilterInputName(new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS));
                    $sensitiveFieldArgNames[] = $customPostStatusFilterInputName;
                }
                break;
        }
        return $sensitiveFieldArgNames;
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['page' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'page':
                if ($pages = $this->getPageTypeAPI()->getPages($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $pages[0];
                }
                return null;
            case 'pages':
                return $this->getPageTypeAPI()->getPages($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'pageCount':
                return $this->getPageTypeAPI()->getPageCount($query);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
