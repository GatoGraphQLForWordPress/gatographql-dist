<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\FieldResolvers\ObjectType;

use PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface;
use PoPCMSSchema\Menus\TypeResolvers\InputObjectType\MenuByInputObjectTypeResolver;
use PoPCMSSchema\Menus\TypeResolvers\InputObjectType\MenuSortInputObjectTypeResolver;
use PoPCMSSchema\Menus\TypeResolvers\InputObjectType\RootMenuPaginationInputObjectTypeResolver;
use PoPCMSSchema\Menus\TypeResolvers\InputObjectType\RootMenusFilterInputObjectTypeResolver;
use PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuObjectTypeResolver|null
     */
    private $menuObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface|null
     */
    private $menuTypeAPI;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\InputObjectType\MenuByInputObjectTypeResolver|null
     */
    private $menuByInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\InputObjectType\RootMenusFilterInputObjectTypeResolver|null
     */
    private $rootMenusFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\InputObjectType\RootMenuPaginationInputObjectTypeResolver|null
     */
    private $rootMenuPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\InputObjectType\MenuSortInputObjectTypeResolver|null
     */
    private $menuSortInputObjectTypeResolver;
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    protected final function getMenuObjectTypeResolver() : MenuObjectTypeResolver
    {
        if ($this->menuObjectTypeResolver === null) {
            /** @var MenuObjectTypeResolver */
            $menuObjectTypeResolver = $this->instanceManager->getInstance(MenuObjectTypeResolver::class);
            $this->menuObjectTypeResolver = $menuObjectTypeResolver;
        }
        return $this->menuObjectTypeResolver;
    }
    protected final function getMenuTypeAPI() : MenuTypeAPIInterface
    {
        if ($this->menuTypeAPI === null) {
            /** @var MenuTypeAPIInterface */
            $menuTypeAPI = $this->instanceManager->getInstance(MenuTypeAPIInterface::class);
            $this->menuTypeAPI = $menuTypeAPI;
        }
        return $this->menuTypeAPI;
    }
    protected final function getMenuByInputObjectTypeResolver() : MenuByInputObjectTypeResolver
    {
        if ($this->menuByInputObjectTypeResolver === null) {
            /** @var MenuByInputObjectTypeResolver */
            $menuByInputObjectTypeResolver = $this->instanceManager->getInstance(MenuByInputObjectTypeResolver::class);
            $this->menuByInputObjectTypeResolver = $menuByInputObjectTypeResolver;
        }
        return $this->menuByInputObjectTypeResolver;
    }
    protected final function getRootMenusFilterInputObjectTypeResolver() : RootMenusFilterInputObjectTypeResolver
    {
        if ($this->rootMenusFilterInputObjectTypeResolver === null) {
            /** @var RootMenusFilterInputObjectTypeResolver */
            $rootMenusFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootMenusFilterInputObjectTypeResolver::class);
            $this->rootMenusFilterInputObjectTypeResolver = $rootMenusFilterInputObjectTypeResolver;
        }
        return $this->rootMenusFilterInputObjectTypeResolver;
    }
    protected final function getRootMenuPaginationInputObjectTypeResolver() : RootMenuPaginationInputObjectTypeResolver
    {
        if ($this->rootMenuPaginationInputObjectTypeResolver === null) {
            /** @var RootMenuPaginationInputObjectTypeResolver */
            $rootMenuPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(RootMenuPaginationInputObjectTypeResolver::class);
            $this->rootMenuPaginationInputObjectTypeResolver = $rootMenuPaginationInputObjectTypeResolver;
        }
        return $this->rootMenuPaginationInputObjectTypeResolver;
    }
    protected final function getMenuSortInputObjectTypeResolver() : MenuSortInputObjectTypeResolver
    {
        if ($this->menuSortInputObjectTypeResolver === null) {
            /** @var MenuSortInputObjectTypeResolver */
            $menuSortInputObjectTypeResolver = $this->instanceManager->getInstance(MenuSortInputObjectTypeResolver::class);
            $this->menuSortInputObjectTypeResolver = $menuSortInputObjectTypeResolver;
        }
        return $this->menuSortInputObjectTypeResolver;
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
        return ['menu', 'menus', 'menuCount'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'menu':
                return $this->__('Get a menu', 'menus');
            case 'menus':
                return $this->__('Get all menus', 'menus');
            case 'menuCount':
                return $this->__('Count the number of menus', 'menus');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'menu':
                return $this->getMenuObjectTypeResolver();
            case 'menus':
                return $this->getMenuObjectTypeResolver();
            case 'menuCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'menus':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            case 'menuCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'menu':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getMenuByInputObjectTypeResolver()]);
            case 'menus':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMenusFilterInputObjectTypeResolver(), 'pagination' => $this->getRootMenuPaginationInputObjectTypeResolver(), 'sort' => $this->getMenuSortInputObjectTypeResolver()]);
            case 'menuCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMenusFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['menu' => 'by']:
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
        switch ($fieldDataAccessor->getFieldName()) {
            case 'menu':
                $by = $fieldDataAccessor->getValue('by');
                if (isset($by->id)) {
                    // Validate the ID exists
                    $menuID = $by->id;
                    if ($this->getMenuTypeAPI()->getMenu($menuID) !== null) {
                        return $menuID;
                    }
                }
                return null;
        }
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'menus':
                return $this->getMenuTypeAPI()->getMenus($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'menuCount':
                return $this->getMenuTypeAPI()->getMenuCount($query);
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
