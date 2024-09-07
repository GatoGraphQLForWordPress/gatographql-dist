<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\Categories\RelationalTypeDataLoaders\ObjectType\AbstractCategoryObjectTypeDataLoader;
use PoPCMSSchema\Categories\TypeAPIs\CategoryTypeAPIInterface;
use PoPCMSSchema\Categories\TypeAPIs\QueryableCategoryTypeAPIInterface;
/** @internal */
class QueryableCategoryListObjectTypeDataLoader extends AbstractCategoryObjectTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\Categories\TypeAPIs\QueryableCategoryTypeAPIInterface|null
     */
    private $queryableCategoryListTypeAPI;
    public final function setQueryableCategoryTypeAPI(QueryableCategoryTypeAPIInterface $queryableCategoryListTypeAPI) : void
    {
        $this->queryableCategoryListTypeAPI = $queryableCategoryListTypeAPI;
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
    public function getCategoryTypeAPI() : CategoryTypeAPIInterface
    {
        return $this->getQueryableCategoryTypeAPI();
    }
}
