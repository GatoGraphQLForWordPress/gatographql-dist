<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\RootTagsFilterInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagPaginationInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\UnionType\TagUnionTypeResolver;
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
class RootTagObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
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
     * @var \PoPCMSSchema\Tags\TypeResolvers\UnionType\TagUnionTypeResolver|null
     */
    private $tagUnionTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver|null
     */
    private $tagByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\EnumType\TagTaxonomyEnumStringScalarTypeResolver|null
     */
    private $tagTaxonomyEnumStringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\TagPaginationInputObjectTypeResolver|null
     */
    private $tagPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver|null
     */
    private $taxonomySortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\RootTagsFilterInputObjectTypeResolver|null
     */
    private $rootTagsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface|null
     */
    private $queryableTagTypeAPI;
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
    public final function setTagUnionTypeResolver(TagUnionTypeResolver $tagUnionTypeResolver) : void
    {
        $this->tagUnionTypeResolver = $tagUnionTypeResolver;
    }
    protected final function getTagUnionTypeResolver() : TagUnionTypeResolver
    {
        if ($this->tagUnionTypeResolver === null) {
            /** @var TagUnionTypeResolver */
            $tagUnionTypeResolver = $this->instanceManager->getInstance(TagUnionTypeResolver::class);
            $this->tagUnionTypeResolver = $tagUnionTypeResolver;
        }
        return $this->tagUnionTypeResolver;
    }
    public final function setTagByOneofInputObjectTypeResolver(TagByOneofInputObjectTypeResolver $tagByOneofInputObjectTypeResolver) : void
    {
        $this->tagByOneofInputObjectTypeResolver = $tagByOneofInputObjectTypeResolver;
    }
    protected final function getTagByOneofInputObjectTypeResolver() : TagByOneofInputObjectTypeResolver
    {
        if ($this->tagByOneofInputObjectTypeResolver === null) {
            /** @var TagByOneofInputObjectTypeResolver */
            $tagByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(TagByOneofInputObjectTypeResolver::class);
            $this->tagByOneofInputObjectTypeResolver = $tagByOneofInputObjectTypeResolver;
        }
        return $this->tagByOneofInputObjectTypeResolver;
    }
    public final function setTagTaxonomyEnumStringScalarTypeResolver(TagTaxonomyEnumStringScalarTypeResolver $tagTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->tagTaxonomyEnumStringScalarTypeResolver = $tagTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getTagTaxonomyEnumStringScalarTypeResolver() : TagTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->tagTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var TagTaxonomyEnumStringScalarTypeResolver */
            $tagTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(TagTaxonomyEnumStringScalarTypeResolver::class);
            $this->tagTaxonomyEnumStringScalarTypeResolver = $tagTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->tagTaxonomyEnumStringScalarTypeResolver;
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
    public final function setRootTagsFilterInputObjectTypeResolver(RootTagsFilterInputObjectTypeResolver $rootTagsFilterInputObjectTypeResolver) : void
    {
        $this->rootTagsFilterInputObjectTypeResolver = $rootTagsFilterInputObjectTypeResolver;
    }
    protected final function getRootTagsFilterInputObjectTypeResolver() : RootTagsFilterInputObjectTypeResolver
    {
        if ($this->rootTagsFilterInputObjectTypeResolver === null) {
            /** @var RootTagsFilterInputObjectTypeResolver */
            $rootTagsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootTagsFilterInputObjectTypeResolver::class);
            $this->rootTagsFilterInputObjectTypeResolver = $rootTagsFilterInputObjectTypeResolver;
        }
        return $this->rootTagsFilterInputObjectTypeResolver;
    }
    public final function setQueryableTagTypeAPI(QueryableTagTypeAPIInterface $queryableTagTypeAPI) : void
    {
        $this->queryableTagTypeAPI = $queryableTagTypeAPI;
    }
    protected final function getQueryableTagTypeAPI() : QueryableTagTypeAPIInterface
    {
        if ($this->queryableTagTypeAPI === null) {
            /** @var QueryableTagTypeAPIInterface */
            $queryableTagTypeAPI = $this->instanceManager->getInstance(QueryableTagTypeAPIInterface::class);
            $this->queryableTagTypeAPI = $queryableTagTypeAPI;
        }
        return $this->queryableTagTypeAPI;
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
        return ['tag', 'tags', 'tagCount', 'tagNames'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'tag':
            case 'tags':
                return $this->getTagUnionTypeResolver();
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
            case 'tag':
                return $this->__('Retrieve a single tag', 'tags');
            case 'tags':
                return $this->__(' tags', 'tags');
            case 'tagCount':
                return $this->__('Number of tags', 'tags');
            case 'tagNames':
                return $this->__('Names of the tags', 'tags');
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
        $commonFieldArgNameTypeResolvers = ['taxonomy' => $this->getTagTaxonomyEnumStringScalarTypeResolver()];
        switch ($fieldName) {
            case 'tag':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['by' => $this->getTagByOneofInputObjectTypeResolver()]);
            case 'tags':
            case 'tagNames':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['filter' => $this->getRootTagsFilterInputObjectTypeResolver(), 'pagination' => $this->getTagPaginationInputObjectTypeResolver(), 'sort' => $this->getTaxonomySortInputObjectTypeResolver()]);
            case 'tagCount':
                return \array_merge($fieldArgNameTypeResolvers, $commonFieldArgNameTypeResolvers, ['filter' => $this->getRootTagsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['tag' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        if ($fieldArgName === 'taxonomy') {
            return $this->__('Taxonomy of the tag', 'tags');
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['tag' => 'by']:
                return $this->__('Parameter by which to select the tag', 'tags');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return array<string,mixed>
     */
    protected function getQuery(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $query = [];
        /** @var string|null */
        $tagTaxonomy = $fieldDataAccessor->getValue('taxonomy');
        if ($tagTaxonomy !== null) {
            $query['taxonomy'] = $tagTaxonomy;
        }
        return $query;
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), $this->getQuery($objectTypeResolver, $object, $fieldDataAccessor));
        switch ($fieldDataAccessor->getFieldName()) {
            case 'tag':
                if ($tags = $this->getQueryableTagTypeAPI()->getTags($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $tags[0];
                }
                return null;
            case 'tags':
                return $this->getQueryableTagTypeAPI()->getTags($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'tagNames':
                return $this->getQueryableTagTypeAPI()->getTags($query, [QueryOptions::RETURN_TYPE => ReturnTypes::NAMES]);
            case 'tagCount':
                return $this->getQueryableTagTypeAPI()->getTagCount($query);
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
