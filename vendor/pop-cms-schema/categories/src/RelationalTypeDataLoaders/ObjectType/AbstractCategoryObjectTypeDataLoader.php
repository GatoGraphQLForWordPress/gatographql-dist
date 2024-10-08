<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\Categories\TypeAPIs\CategoryTypeAPIInterface;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\App;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeQueryableDataLoader;
/** @internal */
abstract class AbstractCategoryObjectTypeDataLoader extends AbstractObjectTypeQueryableDataLoader
{
    public const HOOK_ALL_OBJECTS_BY_IDS_QUERY = __CLASS__ . ':all-objects-by-ids-query';
    public abstract function getCategoryTypeAPI() : CategoryTypeAPIInterface;
    /**
     * @param array<string|int> $ids
     * @return array<string,mixed>
     */
    public function getQueryToRetrieveObjectsForIDs(array $ids) : array
    {
        return App::applyFilters(self::HOOK_ALL_OBJECTS_BY_IDS_QUERY, ['include' => $ids], $ids);
    }
    protected function getOrderbyDefault() : string
    {
        return $this->getNameResolver()->getName('popcms:dbcolumn:orderby:categories:count');
    }
    protected function getOrderDefault() : string
    {
        return 'DESC';
    }
    /**
     * @return mixed[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function executeQuery(array $query, array $options = []) : array
    {
        return $this->getCategoryTypeAPI()->getCategories($query, $options);
    }
    /**
     * @param array<string,mixed> $query
     * @return array<string|int>
     */
    public function executeQueryIDs(array $query) : array
    {
        $options = [QueryOptions::RETURN_TYPE => ReturnTypes::IDS];
        return $this->executeQuery($query, $options);
    }
}
