<?php

declare (strict_types=1);
namespace PoPCMSSchema\Posts\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver;
use PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface;
use PoPCMSSchema\Posts\TypeResolvers\InputObjectType\PostPaginationInputObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\InputObjectType\RootPostsFilterInputObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
abstract class AbstractPostObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\InputObjectType\RootPostsFilterInputObjectTypeResolver|null
     */
    private $rootPostsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\InputObjectType\PostPaginationInputObjectTypeResolver|null
     */
    private $postPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver|null
     */
    private $customPostSortInputObjectTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface|null
     */
    private $postTypeAPI;
    public final function setRootPostsFilterInputObjectTypeResolver(RootPostsFilterInputObjectTypeResolver $rootPostsFilterInputObjectTypeResolver) : void
    {
        $this->rootPostsFilterInputObjectTypeResolver = $rootPostsFilterInputObjectTypeResolver;
    }
    protected final function getRootPostsFilterInputObjectTypeResolver() : RootPostsFilterInputObjectTypeResolver
    {
        if ($this->rootPostsFilterInputObjectTypeResolver === null) {
            /** @var RootPostsFilterInputObjectTypeResolver */
            $rootPostsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootPostsFilterInputObjectTypeResolver::class);
            $this->rootPostsFilterInputObjectTypeResolver = $rootPostsFilterInputObjectTypeResolver;
        }
        return $this->rootPostsFilterInputObjectTypeResolver;
    }
    public final function setPostPaginationInputObjectTypeResolver(PostPaginationInputObjectTypeResolver $postPaginationInputObjectTypeResolver) : void
    {
        $this->postPaginationInputObjectTypeResolver = $postPaginationInputObjectTypeResolver;
    }
    protected final function getPostPaginationInputObjectTypeResolver() : PostPaginationInputObjectTypeResolver
    {
        if ($this->postPaginationInputObjectTypeResolver === null) {
            /** @var PostPaginationInputObjectTypeResolver */
            $postPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(PostPaginationInputObjectTypeResolver::class);
            $this->postPaginationInputObjectTypeResolver = $postPaginationInputObjectTypeResolver;
        }
        return $this->postPaginationInputObjectTypeResolver;
    }
    public final function setCustomPostSortInputObjectTypeResolver(CustomPostSortInputObjectTypeResolver $customPostSortInputObjectTypeResolver) : void
    {
        $this->customPostSortInputObjectTypeResolver = $customPostSortInputObjectTypeResolver;
    }
    protected final function getCustomPostSortInputObjectTypeResolver() : CustomPostSortInputObjectTypeResolver
    {
        if ($this->customPostSortInputObjectTypeResolver === null) {
            /** @var CustomPostSortInputObjectTypeResolver */
            $customPostSortInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostSortInputObjectTypeResolver::class);
            $this->customPostSortInputObjectTypeResolver = $customPostSortInputObjectTypeResolver;
        }
        return $this->customPostSortInputObjectTypeResolver;
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
    public final function setPostObjectTypeResolver(PostObjectTypeResolver $postObjectTypeResolver) : void
    {
        $this->postObjectTypeResolver = $postObjectTypeResolver;
    }
    protected final function getPostObjectTypeResolver() : PostObjectTypeResolver
    {
        if ($this->postObjectTypeResolver === null) {
            /** @var PostObjectTypeResolver */
            $postObjectTypeResolver = $this->instanceManager->getInstance(PostObjectTypeResolver::class);
            $this->postObjectTypeResolver = $postObjectTypeResolver;
        }
        return $this->postObjectTypeResolver;
    }
    public final function setPostTypeAPI(PostTypeAPIInterface $postTypeAPI) : void
    {
        $this->postTypeAPI = $postTypeAPI;
    }
    protected final function getPostTypeAPI() : PostTypeAPIInterface
    {
        if ($this->postTypeAPI === null) {
            /** @var PostTypeAPIInterface */
            $postTypeAPI = $this->instanceManager->getInstance(PostTypeAPIInterface::class);
            $this->postTypeAPI = $postTypeAPI;
        }
        return $this->postTypeAPI;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['posts', 'postCount'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'posts':
                return $this->getPostObjectTypeResolver();
            case 'postCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'postCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'posts':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'posts':
                return $this->__('Posts', 'pop-posts');
            case 'postCount':
                return $this->__('Number of posts', 'pop-posts');
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
            case 'posts':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootPostsFilterInputObjectTypeResolver(), 'pagination' => $this->getPostPaginationInputObjectTypeResolver(), 'sort' => $this->getCustomPostSortInputObjectTypeResolver()]);
            case 'postCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootPostsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    /**
     * @return array<string,mixed>
     */
    protected function getQuery(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        return [];
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), $this->getQuery($objectTypeResolver, $object, $fieldDataAccessor));
        switch ($fieldDataAccessor->getFieldName()) {
            case 'posts':
                return $this->getPostTypeAPI()->getPosts($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'postCount':
                return $this->getPostTypeAPI()->getPostCount($query);
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
