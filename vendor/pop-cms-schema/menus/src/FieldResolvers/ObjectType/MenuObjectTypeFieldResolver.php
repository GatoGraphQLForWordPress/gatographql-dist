<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\FieldResolvers\ObjectType;

use PoPCMSSchema\Menus\ObjectModels\MenuItem;
use PoPCMSSchema\Menus\RuntimeRegistries\MenuItemRuntimeRegistryInterface;
use PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface;
use PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuItemObjectTypeResolver;
use PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
class MenuObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Menus\RuntimeRegistries\MenuItemRuntimeRegistryInterface|null
     */
    private $menuItemRuntimeRegistry;
    /**
     * @var \PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver|null
     */
    private $jsonObjectScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeResolvers\ObjectType\MenuItemObjectTypeResolver|null
     */
    private $menuItemObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface|null
     */
    private $menuTypeAPI;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    public final function setMenuItemRuntimeRegistry(MenuItemRuntimeRegistryInterface $menuItemRuntimeRegistry) : void
    {
        $this->menuItemRuntimeRegistry = $menuItemRuntimeRegistry;
    }
    protected final function getMenuItemRuntimeRegistry() : MenuItemRuntimeRegistryInterface
    {
        if ($this->menuItemRuntimeRegistry === null) {
            /** @var MenuItemRuntimeRegistryInterface */
            $menuItemRuntimeRegistry = $this->instanceManager->getInstance(MenuItemRuntimeRegistryInterface::class);
            $this->menuItemRuntimeRegistry = $menuItemRuntimeRegistry;
        }
        return $this->menuItemRuntimeRegistry;
    }
    public final function setJSONObjectScalarTypeResolver(JSONObjectScalarTypeResolver $jsonObjectScalarTypeResolver) : void
    {
        $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
    }
    protected final function getJSONObjectScalarTypeResolver() : JSONObjectScalarTypeResolver
    {
        if ($this->jsonObjectScalarTypeResolver === null) {
            /** @var JSONObjectScalarTypeResolver */
            $jsonObjectScalarTypeResolver = $this->instanceManager->getInstance(JSONObjectScalarTypeResolver::class);
            $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
        }
        return $this->jsonObjectScalarTypeResolver;
    }
    public final function setMenuItemObjectTypeResolver(MenuItemObjectTypeResolver $menuItemObjectTypeResolver) : void
    {
        $this->menuItemObjectTypeResolver = $menuItemObjectTypeResolver;
    }
    protected final function getMenuItemObjectTypeResolver() : MenuItemObjectTypeResolver
    {
        if ($this->menuItemObjectTypeResolver === null) {
            /** @var MenuItemObjectTypeResolver */
            $menuItemObjectTypeResolver = $this->instanceManager->getInstance(MenuItemObjectTypeResolver::class);
            $this->menuItemObjectTypeResolver = $menuItemObjectTypeResolver;
        }
        return $this->menuItemObjectTypeResolver;
    }
    public final function setMenuTypeAPI(MenuTypeAPIInterface $menuTypeAPI) : void
    {
        $this->menuTypeAPI = $menuTypeAPI;
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
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [MenuObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['items', 'itemDataEntries'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'items':
                return $this->getMenuItemObjectTypeResolver();
            case 'itemDataEntries':
                return $this->getJSONObjectScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'items':
            case 'itemDataEntries':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'itemDataEntries':
                return ['flat' => $this->getBooleanScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['itemDataEntries' => 'flat']:
                return $this->__('Flatten the items', 'menus');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'items':
                return $this->__('The menu items', 'menus');
            case 'itemDataEntries':
                return $this->__('The data for the menu items', 'menus');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['itemDataEntries' => 'flat']:
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName)
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['itemDataEntries' => 'flat']:
                return \false;
            default:
                return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $menu = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'itemDataEntries':
                $isFlat = $fieldDataAccessor->getValue('flat');
                $menuItems = $this->getMenuTypeAPI()->getMenuItems($menu);
                $entries = array();
                if ($menuItems) {
                    foreach ($menuItems as $menuItem) {
                        // Convert object to array
                        // @see https://stackoverflow.com/a/18576902
                        $item_value = \json_decode((string) \json_encode($menuItem), \true);
                        // Prepare array where to append the children items
                        if (!$isFlat) {
                            $item_value['children'] = [];
                        }
                        $entries[] = $item_value;
                    }
                }
                if ($isFlat) {
                    return \array_map(
                        /** @param mixed[] $entry */
                        function (array $entry) {
                            return (object) $entry;
                        },
                        $entries
                    );
                }
                /**
                 * Reproduce the menu layout in the array
                 */
                $arrangedEntries = [];
                foreach ($entries as $menuItemData) {
                    $arrangedEntriesPointer =& $arrangedEntries;
                    // Reproduce the list of parents
                    if ($menuItemParentID = $menuItemData['parentID']) {
                        $menuItemAncestorIDs = [];
                        while ($menuItemParentID !== null) {
                            $menuItemAncestorIDs[] = $menuItemParentID;
                            $menuItemParentPos = $this->findEntryPosition($menuItemParentID, $entries);
                            $menuItemParentID = $entries[$menuItemParentPos]['parentID'];
                        }
                        // Navigate to that position, and attach the menuItem
                        foreach (\array_reverse($menuItemAncestorIDs) as $menuItemAncestorID) {
                            $menuItemAncestorPos = $this->findEntryPosition($menuItemAncestorID, $arrangedEntriesPointer);
                            $arrangedEntriesPointer =& $arrangedEntriesPointer[$menuItemAncestorPos]['children'];
                        }
                    }
                    $arrangedEntriesPointer[] = $menuItemData;
                }
                return \array_map(
                    /** @param mixed[] $entry */
                    function (array $entry) {
                        return (object) $entry;
                    },
                    $arrangedEntries
                );
            case 'items':
                $menuItems = $this->getMenuTypeAPI()->getMenuItems($menu);
                $menuItemRuntimeRegistry = $this->getMenuItemRuntimeRegistry();
                // Save the MenuItems on the dynamic registry
                foreach ($menuItems as $menuItem) {
                    $menuItemRuntimeRegistry->storeMenuItem($menuItem);
                }
                // Return the IDs for the top-level items (those with no parent)
                return \array_map(function (MenuItem $menuItem) {
                    return $menuItem->id;
                }, \array_filter($menuItems, function (MenuItem $menuItem) {
                    return $menuItem->parentID === null;
                }));
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
    /**
     * @param array<int,array<string,mixed>> $entries
     * @param string|int $menuItemID
     */
    protected function findEntryPosition($menuItemID, array $entries) : int
    {
        $entriesCount = \count($entries);
        for ($pos = 0; $pos < $entriesCount; $pos++) {
            /**
             * Watch out! Can't use `===` because (for some reason) the same value
             * could be passed as int or string!
             */
            if ($entries[$pos]['id'] === $menuItemID) {
                return $pos;
            }
        }
        // It will never reach here, so return anything
        return 0;
    }
}
