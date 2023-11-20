<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\FieldResolvers\ObjectType;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\Categories\ModuleContracts\CategoryAPIRequestedContractObjectTypeFieldResolverInterface;
use PoPCMSSchema\Taxonomies\FieldResolvers\ObjectType\AbstractCustomPostListTaxonomyObjectTypeFieldResolver;
/** @internal */
abstract class AbstractCustomPostListCategoryObjectTypeFieldResolver extends AbstractCustomPostListTaxonomyObjectTypeFieldResolver implements CategoryAPIRequestedContractObjectTypeFieldResolverInterface
{
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'customPosts':
                return $this->__('Custom posts which contain this category', 'pop-categories');
            case 'customPostCount':
                return $this->__('Number of custom posts which contain this category', 'pop-categories');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    protected abstract function getQueryProperty() : string;
    /**
     * @return array<string,mixed>
     */
    protected function getQuery(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $query = parent::getQuery($objectTypeResolver, $object, $fieldDataAccessor);
        $category = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'customPosts':
            case 'customPostCount':
                $query[$this->getQueryProperty()] = [$objectTypeResolver->getID($category)];
                break;
        }
        return $query;
    }
}
