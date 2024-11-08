<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\UnionType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\UnionType\AbstractUnionTypeResolver;
use PoPCMSSchema\Categories\RelationalTypeDataLoaders\UnionType\CategoryUnionTypeDataLoader;
use PoPCMSSchema\Categories\TypeResolvers\InterfaceType\CategoryInterfaceTypeResolver;
/** @internal */
class CategoryUnionTypeResolver extends AbstractUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\Categories\RelationalTypeDataLoaders\UnionType\CategoryUnionTypeDataLoader|null
     */
    private $categoryUnionTypeDataLoader;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InterfaceType\CategoryInterfaceTypeResolver|null
     */
    private $categoryInterfaceTypeResolver;
    protected final function getCategoryUnionTypeDataLoader() : CategoryUnionTypeDataLoader
    {
        if ($this->categoryUnionTypeDataLoader === null) {
            /** @var CategoryUnionTypeDataLoader */
            $categoryUnionTypeDataLoader = $this->instanceManager->getInstance(CategoryUnionTypeDataLoader::class);
            $this->categoryUnionTypeDataLoader = $categoryUnionTypeDataLoader;
        }
        return $this->categoryUnionTypeDataLoader;
    }
    protected final function getCategoryInterfaceTypeResolver() : CategoryInterfaceTypeResolver
    {
        if ($this->categoryInterfaceTypeResolver === null) {
            /** @var CategoryInterfaceTypeResolver */
            $categoryInterfaceTypeResolver = $this->instanceManager->getInstance(CategoryInterfaceTypeResolver::class);
            $this->categoryInterfaceTypeResolver = $categoryInterfaceTypeResolver;
        }
        return $this->categoryInterfaceTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'CategoryUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'category\' type resolvers', 'categories');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCategoryUnionTypeDataLoader();
    }
    /**
     * @return InterfaceTypeResolverInterface[]
     */
    public function getUnionTypeInterfaceTypeResolvers() : array
    {
        return [$this->getCategoryInterfaceTypeResolver()];
    }
}
