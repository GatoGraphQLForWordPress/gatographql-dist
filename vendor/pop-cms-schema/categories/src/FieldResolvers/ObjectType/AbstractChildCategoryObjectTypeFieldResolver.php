<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\FieldResolvers\ObjectType;

use PoPCMSSchema\Categories\ModuleContracts\CategoryAPIRequestedContractObjectTypeFieldResolverInterface;
use PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryPaginationInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomyTaxonomiesFilterInputObjectTypeResolver;
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
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
abstract class AbstractChildCategoryObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver implements CategoryAPIRequestedContractObjectTypeFieldResolverInterface
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomyTaxonomiesFilterInputObjectTypeResolver|null
     */
    private $taxonomyTaxonomiesFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\CategoryPaginationInputObjectTypeResolver|null
     */
    private $categoryPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver|null
     */
    private $taxonomySortInputObjectTypeResolver;
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
    public final function setTaxonomyTaxonomiesFilterInputObjectTypeResolver(TaxonomyTaxonomiesFilterInputObjectTypeResolver $taxonomyTaxonomiesFilterInputObjectTypeResolver) : void
    {
        $this->taxonomyTaxonomiesFilterInputObjectTypeResolver = $taxonomyTaxonomiesFilterInputObjectTypeResolver;
    }
    protected final function getTaxonomyTaxonomiesFilterInputObjectTypeResolver() : TaxonomyTaxonomiesFilterInputObjectTypeResolver
    {
        if ($this->taxonomyTaxonomiesFilterInputObjectTypeResolver === null) {
            /** @var TaxonomyTaxonomiesFilterInputObjectTypeResolver */
            $taxonomyTaxonomiesFilterInputObjectTypeResolver = $this->instanceManager->getInstance(TaxonomyTaxonomiesFilterInputObjectTypeResolver::class);
            $this->taxonomyTaxonomiesFilterInputObjectTypeResolver = $taxonomyTaxonomiesFilterInputObjectTypeResolver;
        }
        return $this->taxonomyTaxonomiesFilterInputObjectTypeResolver;
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
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['children', 'childCount', 'childNames'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'children':
                return $this->getCategoryTypeResolver();
            case 'childCount':
                return $this->getIntScalarTypeResolver();
            case 'childNames':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'childCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'children':
            case 'childNames':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'children':
                return $this->__('Child categories', 'categories');
            case 'childCount':
                return $this->__('Number of child categories', 'categories');
            case 'childNames':
                return $this->__('Names of the child categories', 'categories');
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
        switch ($fieldName) {
            case 'children':
            case 'childNames':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getTaxonomyTaxonomiesFilterInputObjectTypeResolver(), 'pagination' => $this->getCategoryPaginationInputObjectTypeResolver(), 'sort' => $this->getTaxonomySortInputObjectTypeResolver()]);
            case 'childCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getTaxonomyTaxonomiesFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $category = $object;
        $categoryTypeAPI = $this->getCategoryTypeAPI();
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), ['parent-id' => $objectTypeResolver->getID($category)]);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'children':
                return $categoryTypeAPI->getCategories($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'childNames':
                return $categoryTypeAPI->getCategories($query, [QueryOptions::RETURN_TYPE => ReturnTypes::NAMES]);
            case 'childCount':
                return $categoryTypeAPI->getCategoryCount($query);
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
