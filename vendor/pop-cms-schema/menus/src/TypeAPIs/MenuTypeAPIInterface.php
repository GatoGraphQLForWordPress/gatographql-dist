<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\TypeAPIs;

use PoPCMSSchema\Menus\ObjectModels\MenuItem;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface MenuTypeAPIInterface
{
    /**
     * @param string|int $menuID
     */
    public function getMenu($menuID) : ?object;
    /**
     * @return MenuItem[]
     * @param string|int|object $menuObjectOrID
     */
    public function getMenuItems($menuObjectOrID) : array;
    /**
     * @return string|int
     */
    public function getMenuID(object $menu);
    /**
     * @return string|int|null
     */
    public function getMenuIDFromMenuName(string $menuName);
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @return array<string|int|object>
     */
    public function getMenus(array $query, array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getMenuCount(array $query, array $options = []) : int;
}
