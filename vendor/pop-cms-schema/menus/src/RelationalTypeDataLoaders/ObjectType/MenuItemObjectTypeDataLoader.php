<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\RelationalTypeDataLoaders\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
use PoPCMSSchema\Menus\RuntimeRegistries\MenuItemRuntimeRegistryInterface;
/** @internal */
class MenuItemObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\Menus\RuntimeRegistries\MenuItemRuntimeRegistryInterface|null
     */
    private $menuItemRuntimeRegistry;
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
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        // Retrieve each item from the dynamic registry
        return \array_map(\Closure::fromCallable([$this->getMenuItemRuntimeRegistry(), 'getMenuItem']), $ids);
    }
}
