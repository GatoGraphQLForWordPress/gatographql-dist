<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\RuntimeRegistries;

use PoPCMSSchema\Menus\ObjectModels\MenuItem;
/** @internal */
interface MenuItemRuntimeRegistryInterface
{
    public function storeMenuItem(MenuItem $menuItem) : void;
    /**
     * @param string|int $id
     */
    public function getMenuItem($id) : ?MenuItem;
    /** @return array<string|int,MenuItem>
     * @param string|int|\PoPCMSSchema\Menus\ObjectModels\MenuItem $menuItemObjectOrID */
    public function getMenuItemChildren($menuItemObjectOrID) : array;
}
