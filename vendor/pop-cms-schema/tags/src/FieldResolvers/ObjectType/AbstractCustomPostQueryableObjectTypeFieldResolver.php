<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\Tags\ModuleContracts\TagAPIRequestedContractObjectTypeFieldResolverInterface;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\CustomPostTagsFilterInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagPaginationInputObjectTypeResolver;
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
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
abstract class AbstractCustomPostQueryableObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver implements TagAPIRequestedContractObjectTypeFieldResolverInterface
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
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagPaginationInputObjectTypeResolver|null
     */
    private $tagPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver|null
     */
    private $taxonomySortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\CustomPostTagsFilterInputObjectTypeResolver|null
     */
    private $customPostTagsFilterInputObjectTypeResolver;
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
    public final function setTagPaginationInputObjectTypeResolver(TagPaginationInputObjectTypeResolver $tagPaginationInputObjectTypeResolver) : void
    {
        $this->tagPaginationInputObjectTypeResolver = $tagPaginationInputObjectTypeResolver;
    }
    protected final function getTagPaginationInputObjectTypeResolver() : TagPaginationInputObjectTypeResolver
    {
        if ($this->tagPaginationInputObjectTypeResolver === null) {
            /** @var TagPaginationInputObjectTypeResolver */
            $tagPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(TagPaginationInputObjectTypeResolver::class);
            $this->tagPaginationInputObjectTypeResolver = $tagPaginationInputObjectTypeResolver;
        }
        return $this->tagPaginationInputObjectTypeResolver;
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
    public final function setCustomPostTagsFilterInputObjectTypeResolver(CustomPostTagsFilterInputObjectTypeResolver $customPostTagsFilterInputObjectTypeResolver) : void
    {
        $this->customPostTagsFilterInputObjectTypeResolver = $customPostTagsFilterInputObjectTypeResolver;
    }
    protected final function getCustomPostTagsFilterInputObjectTypeResolver() : CustomPostTagsFilterInputObjectTypeResolver
    {
        if ($this->customPostTagsFilterInputObjectTypeResolver === null) {
            /** @var CustomPostTagsFilterInputObjectTypeResolver */
            $customPostTagsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostTagsFilterInputObjectTypeResolver::class);
            $this->customPostTagsFilterInputObjectTypeResolver = $customPostTagsFilterInputObjectTypeResolver;
        }
        return $this->customPostTagsFilterInputObjectTypeResolver;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['tags', 'tagCount', 'tagNames'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'tags':
                return $this->getTagTypeResolver();
            case 'tagCount':
                return $this->getIntScalarTypeResolver();
            case 'tagNames':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'tagCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'tags':
            case 'tagNames':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'tags':
                return $this->__('Tags added to this custom post', 'pop-tags');
            case 'tagCount':
                return $this->__('Number of tags added to this custom post', 'pop-tags');
            case 'tagNames':
                return $this->__('Names of the tags added to this custom post', 'pop-tags');
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
            case 'tags':
            case 'tagNames':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCustomPostTagsFilterInputObjectTypeResolver(), 'pagination' => $this->getTagPaginationInputObjectTypeResolver(), 'sort' => $this->getTaxonomySortInputObjectTypeResolver()]);
            case 'tagCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getCustomPostTagsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $tagTypeAPI = $this->getTagTypeAPI();
        $customPost = $object;
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'tags':
                return $tagTypeAPI->getCustomPostTags($customPost, $query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'tagNames':
                return $tagTypeAPI->getCustomPostTags($customPost, $query, [QueryOptions::RETURN_TYPE => ReturnTypes::NAMES]);
            case 'tagCount':
                /** @var int */
                return $tagTypeAPI->getCustomPostTagCount($customPost, $query);
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
