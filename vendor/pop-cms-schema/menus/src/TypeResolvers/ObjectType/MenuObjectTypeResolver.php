<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoPCMSSchema\Menus\RelationalTypeDataLoaders\ObjectType\MenuObjectTypeDataLoader;
use PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface;
class MenuObjectTypeResolver extends AbstractObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Menus\RelationalTypeDataLoaders\ObjectType\MenuObjectTypeDataLoader|null
     */
    private $menuObjectTypeDataLoader;
    /**
     * @var \PoPCMSSchema\Menus\TypeAPIs\MenuTypeAPIInterface|null
     */
    private $menuTypeAPI;
    public final function setMenuObjectTypeDataLoader(MenuObjectTypeDataLoader $menuObjectTypeDataLoader) : void
    {
        $this->menuObjectTypeDataLoader = $menuObjectTypeDataLoader;
    }
    protected final function getMenuObjectTypeDataLoader() : MenuObjectTypeDataLoader
    {
        if ($this->menuObjectTypeDataLoader === null) {
            /** @var MenuObjectTypeDataLoader */
            $menuObjectTypeDataLoader = $this->instanceManager->getInstance(MenuObjectTypeDataLoader::class);
            $this->menuObjectTypeDataLoader = $menuObjectTypeDataLoader;
        }
        return $this->menuObjectTypeDataLoader;
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
    public function getTypeName() : string
    {
        return 'Menu';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Representation of a navigation menu', 'menus');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        $menu = $object;
        return $this->getMenuTypeAPI()->getMenuID($menu);
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getMenuObjectTypeDataLoader();
    }
}
