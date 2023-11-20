<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\FieldResolvers\ObjectType;

use PoPCMSSchema\Categories\TypeAPIs\QueryableTaxonomyCategoryListTypeAPIInterface;
use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryPaginationInputObjectTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\RootCategoriesFilterInputObjectTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\UnionType\CategoryUnionTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class RootCategoryObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\UnionType\CategoryUnionTypeResolver|null
     */
    private $categoryUnionTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeAPIs\QueryableTaxonomyCategoryListTypeAPIInterface|null
     */
    private $queryableTaxonomyCategoryListTypeAPI;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryByOneofInputObjectTypeResolver|null
     */
    private $categoryByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver|null
     */
    private $categoryTaxonomyEnumStringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\RootCategoriesFilterInputObjectTypeResolver|null
     */
    private $rootCategoriesFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryPaginationInputObjectTypeResolver|null
     */
    private $categoryPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver|null
     */
    private $taxonomySortInputObjectTypeResolver;
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    public final function setCategoryUnionTypeResolver(CategoryUnionTypeResolver $categoryUnionTypeResolver) : void
    {
        $this->categoryUnionTypeResolver = $categoryUnionTypeResolver;
    }
    protected final function getCategoryUnionTypeResolver() : CategoryUnionTypeResolver
    {
        if ($this->categoryUnionTypeResolver === null) {
            /** @var CategoryUnionTypeResolver */
            $categoryUnionTypeResolver = $this->instanceManager->getInstance(CategoryUnionTypeResolver::class);
            $this->categoryUnionTypeResolver = $categoryUnionTypeResolver;
        }
        return $this->categoryUnionTypeResolver;
    }
    public final function setQueryableTaxonomyCategoryListTypeAPI(QueryableTaxonomyCategoryListTypeAPIInterface $queryableTaxonomyCategoryListTypeAPI) : void
    {
        $this->queryableTaxonomyCategoryListTypeAPI = $queryableTaxonomyCategoryListTypeAPI;
    }
    protected final function getQueryableTaxonomyCategoryListTypeAPI() : QueryableTaxonomyCategoryListTypeAPIInterface
    {
        if ($this->queryableTaxonomyCategoryListTypeAPI === null) {
            /** @var QueryableTaxonomyCategoryListTypeAPIInterface */
            $queryableTaxonomyCategoryListTypeAPI = $this->instanceManager->getInstance(QueryableTaxonomyCategoryListTypeAPIInterface::class);
            $this->queryableTaxonomyCategoryListTypeAPI = $queryableTaxonomyCategoryListTypeAPI;
        }
        return $this->queryableTaxonomyCategoryListTypeAPI;
    }
    public final function setCategoryByOneofInputObjectTypeResolver(CategoryByOneofInputObjectTypeResolver $categoryByOneofInputObjectTypeResolver) : void
    {
        $this->categoryByOneofInputObjectTypeResolver = $categoryByOneofInputObjectTypeResolver;
    }
    protected final function getCategoryByOneofInputObjectTypeResolver() : CategoryByOneofInputObjectTypeResolver
    {
        if ($this->categoryByOneofInputObjectTypeResolver === null) {
            /** @var CategoryByOneofInputObjectTypeResolver */
            $categoryByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryByOneofInputObjectTypeResolver::class);
            $this->categoryByOneofInputObjectTypeResolver = $categoryByOneofInputObjectTypeResolver;
        }
        return $this->categoryByOneofInputObjectTypeResolver;
    }
    public final function setCategoryTaxonomyEnumStringScalarTypeResolver(CategoryTaxonomyEnumStringScalarTypeResolver $categoryTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getCategoryTaxonomyEnumStringScalarTypeResolver() : CategoryTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->categoryTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var CategoryTaxonomyEnumStringScalarTypeResolver */
            $categoryTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CategoryTaxonomyEnumStringScalarTypeResolver::class);
            $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->categoryTaxonomyEnumStringScalarTypeResolver;
    }
    public final function setRootCategoriesFilterInputObjectTypeResolver(RootCategoriesFilterInputObjectTypeResolver $rootCategoriesFilterInputObjectTypeResolver) : void
    {
        $this->rootCategoriesFilterInputObjectTypeResolver = $rootCategoriesFilterInputObjectTypeResolver;
    }
    protected final function getRootCategoriesFilterInputObjectTypeResolver() : RootCategoriesFilterInputObjectTypeResolver
    {
        if ($this->rootCategoriesFilterInputObjectTypeResolver === null) {
            /** @var RootCategoriesFilterInputObjectTypeResolver */
            $rootCategoriesFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootCategoriesFilterInputObjectTypeResolver::class);
            $this->rootCategoriesFilterInputObjectTypeResolver = $rootCategoriesFilterInputObjectTypeResolver;
        }
        return $this->rootCategoriesFilterInputObjectTypeResolver;
    }
    public final function setCategoryPaginationInputObjectTypeResolver(CategoryPaginationInputObjectTypeResolver $categoryPaginationInputObjectTypeResolver) : void
    {
        $this->categoryPaginationInputObjectTypeResolver = $categoryPaginationInputObjectTypeResolver;
    }
    protected final function getCategoryPaginationInputObjectTypeResolver() : CategoryPaginationInputObjectTypeResolver
    {
        if ($this->categoryPaginationInputObjectTypeResolver === null) {
            /** @var CategoryPaginationInputObjectTypeResolver */
            $categoryPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryPaginationInputObjectTypeResolver::class);
            $this->categoryPaginationInputObjectTypeResolver = $categoryPaginationInputObjectTypeResolver;
        }
        return $this->categoryPaginationInputObjectTypeResolver;
    }
    public final function setTaxonomySortInputObjectTypeResolver(TaxonomySortInputObjectTypeResolver $taxonomySortInputObjectTypeResolver) : void
    {
        $this->taxonomySortInputObjectTypeResolver = $taxonomySortInputObjectTypeResolver;
    }
    protected final function getTaxonomySortInputObjectTypeResolver() : TaxonomySortInputObjectTypeResolver
    {
        if ($this->taxonomySortInputObjectTypeResolver === null) {
            /** @var TaxonomySortInputObjectTypeResolver */
            $taxonomySortInputObjectTypeResolver = $this->instanceManager->getInstance(TaxonomySortInputObjectTypeResolver::class);
            $this->taxonomySortInputObjectTypeResolver = $taxonomySortInputObjectTypeResolver;
        }
        return $this->taxonomySortInputObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['category', 'categories', 'categoryCount', 'categoryNames'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'category':
            case 'categories':
                return $this->getCategoryUnionTypeResolver();
            case 'categoryCount':
                return $this->getIntScalarTypeResolver();
            case 'categoryNames':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'categoryCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'categories':
            case 'categoryNames':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'category':
                return $this->__('Retrieve a single category', 'categories');
            case 'categories':
                return $this->__('Categories', 'categories');
            case 'categoryCount':
                return $this->__('Number of categories', 'categories');
            case 'categoryNames':
                return $this->__('Names of the categories', 'categories');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        $commonFieldArgNameTypeResolvers = ['taxonomy' => $this->getCategoryTaxonomyEnumStringScalarTypeResolver()];
        switch ($fieldName) {
            case 'category':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['by' => $this->getCategoryByOneofInputObjectTypeResolver()]);
            case 'categories':
            case 'categoryNames':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['filter' => $this->getRootCategoriesFilterInputObjectTypeResolver(), 'pagination' => $this->getCategoryPaginationInputObjectTypeResolver(), 'sort' => $this->getTaxonomySortInputObjectTypeResolver()]);
            case 'categoryCount':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['filter' => $this->getRootCategoriesFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if ($fieldArgName === 'taxonomy') {
            return SchemaTypeModifiers::MANDATORY;
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['category' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        if ($fieldArgName === 'taxonomy') {
            return $this->__('Taxonomy of the category', 'categories');
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['category' => 'by']:
                return $this->__('Parameter by which to select the category', 'categories');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor);
        /** @var string */
        $catTaxonomy = $fieldDataAccessor->getValue('taxonomy');
        switch ($fieldDataAccessor->getFieldName()) {
            case 'category':
                if ($categories = $this->getQueryableTaxonomyCategoryListTypeAPI()->getTaxonomyCategories($catTaxonomy, $query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $categories[0];
                }
                return null;
            case 'categories':
                return $this->getQueryableTaxonomyCategoryListTypeAPI()->getTaxonomyCategories($catTaxonomy, $query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'categoryNames':
                return $this->getQueryableTaxonomyCategoryListTypeAPI()->getTaxonomyCategories($catTaxonomy, $query, [QueryOptions::RETURN_TYPE => ReturnTypes::NAMES]);
            case 'categoryCount':
                return $this->getQueryableTaxonomyCategoryListTypeAPI()->getTaxonomyCategoryCount($catTaxonomy, $query);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
