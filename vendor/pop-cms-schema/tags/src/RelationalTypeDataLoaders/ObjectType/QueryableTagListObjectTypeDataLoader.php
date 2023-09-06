<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\Tags\RelationalTypeDataLoaders\ObjectType\AbstractTagObjectTypeDataLoader;
use PoPCMSSchema\Tags\TypeAPIs\TagListTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface;
class QueryableTagListObjectTypeDataLoader extends AbstractTagObjectTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface|null
     */
    private $queryableTagListTypeAPI;
    public final function setQueryableTagTypeAPI(QueryableTagTypeAPIInterface $queryableTagListTypeAPI) : void
    {
        $this->queryableTagListTypeAPI = $queryableTagListTypeAPI;
    }
    protected final function getQueryableTagTypeAPI() : QueryableTagTypeAPIInterface
    {
        if ($this->queryableTagListTypeAPI === null) {
            /** @var QueryableTagTypeAPIInterface */
            $queryableTagListTypeAPI = $this->instanceManager->getInstance(QueryableTagTypeAPIInterface::class);
            $this->queryableTagListTypeAPI = $queryableTagListTypeAPI;
        }
        return $this->queryableTagListTypeAPI;
    }
    public function getTagListTypeAPI() : TagListTypeAPIInterface
    {
        return $this->getQueryableTagTypeAPI();
    }
}
