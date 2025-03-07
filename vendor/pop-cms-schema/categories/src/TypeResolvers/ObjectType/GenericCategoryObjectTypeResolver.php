<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\ObjectType;

use PoPCMSSchema\Categories\RelationalTypeDataLoaders\ObjectType\QueryableCategoryListObjectTypeDataLoader;
use PoPCMSSchema\Categories\TypeAPIs\CategoryTypeAPIInterface;
use PoPCMSSchema\Categories\TypeAPIs\QueryableCategoryTypeAPIInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/**
 * Class to be used only when a Generic Category Type is good enough.
 * Otherwise, a specific type for the entity should be employed.
 * @internal
 */
class GenericCategoryObjectTypeResolver extends \PoPCMSSchema\Categories\TypeResolvers\ObjectType\AbstractCategoryObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Categories\RelationalTypeDataLoaders\ObjectType\QueryableCategoryListObjectTypeDataLoader|null
     */
    private $queryableCategoryListObjectTypeDataLoader;
    /**
     * @var \PoPCMSSchema\Categories\TypeAPIs\QueryableCategoryTypeAPIInterface|null
     */
    private $queryableCategoryListTypeAPI;
    protected final function getQueryableCategoryListObjectTypeDataLoader() : QueryableCategoryListObjectTypeDataLoader
    {
        if ($this->queryableCategoryListObjectTypeDataLoader === null) {
            /** @var QueryableCategoryListObjectTypeDataLoader */
            $queryableCategoryListObjectTypeDataLoader = $this->instanceManager->getInstance(QueryableCategoryListObjectTypeDataLoader::class);
            $this->queryableCategoryListObjectTypeDataLoader = $queryableCategoryListObjectTypeDataLoader;
        }
        return $this->queryableCategoryListObjectTypeDataLoader;
    }
    protected final function getQueryableCategoryTypeAPI() : QueryableCategoryTypeAPIInterface
    {
        if ($this->queryableCategoryListTypeAPI === null) {
            /** @var QueryableCategoryTypeAPIInterface */
            $queryableCategoryListTypeAPI = $this->instanceManager->getInstance(QueryableCategoryTypeAPIInterface::class);
            $this->queryableCategoryListTypeAPI = $queryableCategoryListTypeAPI;
        }
        return $this->queryableCategoryListTypeAPI;
    }
    public function getTypeName() : string
    {
        return 'GenericCategory';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('A category that does not have its own type in the schema', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getQueryableCategoryListObjectTypeDataLoader();
    }
    public function getCategoryTypeAPI() : CategoryTypeAPIInterface
    {
        return $this->getQueryableCategoryTypeAPI();
    }
}
