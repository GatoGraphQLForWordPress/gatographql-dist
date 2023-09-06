<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootMyCustomPostsFilterInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\ComponentProcessors\CommonCustomPostFilterInputContainerComponentProcessor;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\CustomPosts\TypeHelpers\CustomPostUnionTypeHelpers;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostByOneofInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostPaginationInputObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
class RootQueryableObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface|null
     */
    private $customPostTypeAPI;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostByOneofInputObjectTypeResolver|null
     */
    private $customPostByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootMyCustomPostsFilterInputObjectTypeResolver|null
     */
    private $rootMyCustomPostsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostPaginationInputObjectTypeResolver|null
     */
    private $customPostPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\CustomPostSortInputObjectTypeResolver|null
     */
    private $customPostSortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
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
    public final function setCustomPostTypeAPI(CustomPostTypeAPIInterface $customPostTypeAPI) : void
    {
        $this->customPostTypeAPI = $customPostTypeAPI;
    }
    protected final function getCustomPostTypeAPI() : CustomPostTypeAPIInterface
    {
        if ($this->customPostTypeAPI === null) {
            /** @var CustomPostTypeAPIInterface */
            $customPostTypeAPI = $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
            $this->customPostTypeAPI = $customPostTypeAPI;
        }
        return $this->customPostTypeAPI;
    }
    public final function setCustomPostByOneofInputObjectTypeResolver(CustomPostByOneofInputObjectTypeResolver $customPostByOneofInputObjectTypeResolver) : void
    {
        $this->customPostByOneofInputObjectTypeResolver = $customPostByOneofInputObjectTypeResolver;
    }
    protected final function getCustomPostByOneofInputObjectTypeResolver() : CustomPostByOneofInputObjectTypeResolver
    {
        if ($this->customPostByOneofInputObjectTypeResolver === null) {
            /** @var CustomPostByOneofInputObjectTypeResolver */
            $customPostByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostByOneofInputObjectTypeResolver::class);
            $this->customPostByOneofInputObjectTypeResolver = $customPostByOneofInputObjectTypeResolver;
        }
        return $this->customPostByOneofInputObjectTypeResolver;
    }
    public final function setRootMyCustomPostsFilterInputObjectTypeResolver(RootMyCustomPostsFilterInputObjectTypeResolver $rootMyCustomPostsFilterInputObjectTypeResolver) : void
    {
        $this->rootMyCustomPostsFilterInputObjectTypeResolver = $rootMyCustomPostsFilterInputObjectTypeResolver;
    }
    protected final function getRootMyCustomPostsFilterInputObjectTypeResolver() : RootMyCustomPostsFilterInputObjectTypeResolver
    {
        if ($this->rootMyCustomPostsFilterInputObjectTypeResolver === null) {
            /** @var RootMyCustomPostsFilterInputObjectTypeResolver */
            $rootMyCustomPostsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootMyCustomPostsFilterInputObjectTypeResolver::class);
            $this->rootMyCustomPostsFilterInputObjectTypeResolver = $rootMyCustomPostsFilterInputObjectTypeResolver;
        }
        return $this->rootMyCustomPostsFilterInputObjectTypeResolver;
    }
    public final function setCustomPostPaginationInputObjectTypeResolver(CustomPostPaginationInputObjectTypeResolver $customPostPaginationInputObjectTypeResolver) : void
    {
        $this->customPostPaginationInputObjectTypeResolver = $customPostPaginationInputObjectTypeResolver;
    }
    protected final function getCustomPostPaginationInputObjectTypeResolver() : CustomPostPaginationInputObjectTypeResolver
    {
        if ($this->customPostPaginationInputObjectTypeResolver === null) {
            /** @var CustomPostPaginationInputObjectTypeResolver */
            $customPostPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostPaginationInputObjectTypeResolver::class);
            $this->customPostPaginationInputObjectTypeResolver = $customPostPaginationInputObjectTypeResolver;
        }
        return $this->customPostPaginationInputObjectTypeResolver;
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
    public final function setUserLoggedInCheckpoint(UserLoggedInCheckpoint $userLoggedInCheckpoint) : void
    {
        $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
    }
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
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
        return ['myCustomPosts', 'myCustomPostCount', 'myCustomPost'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'myCustomPosts':
                return CustomPostUnionTypeHelpers::getCustomPostUnionOrTargetObjectTypeResolver();
            case 'myCustomPost':
                return CustomPostUnionTypeHelpers::getCustomPostUnionOrTargetObjectTypeResolver();
            case 'myCustomPostCount':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'myCustomPostCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'myCustomPosts':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'myCustomPosts':
                return $this->__('Custom posts by the logged-in user', 'custompost-mutations');
            case 'myCustomPostCount':
                return $this->__('Number of custom posts by the logged-in user', 'custompost-mutations');
            case 'myCustomPost':
                return $this->__('Retrieve a single custom post', 'custompost-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component
    {
        switch ($fieldName) {
            case 'myCustomPost':
                return new Component(CommonCustomPostFilterInputContainerComponentProcessor::class, CommonCustomPostFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_CUSTOMPOST_BY_STATUS_UNIONTYPE);
            default:
                return parent::getFieldFilterInputContainerComponent($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'myCustomPost':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getCustomPostByOneofInputObjectTypeResolver()]);
            case 'myCustomPosts':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyCustomPostsFilterInputObjectTypeResolver(), 'pagination' => $this->getCustomPostPaginationInputObjectTypeResolver(), 'sort' => $this->getCustomPostSortInputObjectTypeResolver()]);
            case 'myCustomPostCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyCustomPostsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['myCustomPost' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return array<string,mixed>
     */
    protected function getQuery(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'myCustomPost':
            case 'myCustomPosts':
            case 'myCustomPostCount':
                return ['authors' => [App::getState('current-user-id')]];
            default:
                return [];
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), $this->getQuery($objectTypeResolver, $object, $fieldDataAccessor));
        switch ($fieldDataAccessor->getFieldName()) {
            case 'myCustomPostCount':
                return $this->getCustomPostTypeAPI()->getCustomPostCount($query);
            case 'myCustomPosts':
                return $this->getCustomPostTypeAPI()->getCustomPosts($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'myCustomPost':
                if ($customPosts = $this->getCustomPostTypeAPI()->getCustomPosts($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $customPosts[0];
                }
                return null;
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
    /**
     * @return CheckpointInterface[]
     */
    public function getValidationCheckpoints(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, object $object) : array
    {
        $validationCheckpoints = parent::getValidationCheckpoints($objectTypeResolver, $fieldDataAccessor, $object);
        $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
        return $validationCheckpoints;
    }
}
