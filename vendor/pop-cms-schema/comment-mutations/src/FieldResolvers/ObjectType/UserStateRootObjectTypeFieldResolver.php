<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootMyCommentsFilterInputObjectTypeResolver;
use PoPCMSSchema\Comments\ComponentProcessors\SingleCommentFilterInputContainerComponentProcessor;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentByOneofInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\InputObjectType\RootCommentPaginationInputObjectTypeResolver;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
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
class UserStateRootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;
    /**
     * @var \PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface|null
     */
    private $commentTypeAPI;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentByOneofInputObjectTypeResolver|null
     */
    private $commentByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\RootMyCommentsFilterInputObjectTypeResolver|null
     */
    private $rootMyCommentsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\RootCommentPaginationInputObjectTypeResolver|null
     */
    private $rootCommentPaginationInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\InputObjectType\CommentSortInputObjectTypeResolver|null
     */
    private $commentSortInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    public final function setCommentTypeAPI(CommentTypeAPIInterface $commentTypeAPI) : void
    {
        $this->commentTypeAPI = $commentTypeAPI;
    }
    protected final function getCommentTypeAPI() : CommentTypeAPIInterface
    {
        if ($this->commentTypeAPI === null) {
            /** @var CommentTypeAPIInterface */
            $commentTypeAPI = $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
            $this->commentTypeAPI = $commentTypeAPI;
        }
        return $this->commentTypeAPI;
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
    public final function setCommentObjectTypeResolver(CommentObjectTypeResolver $commentObjectTypeResolver) : void
    {
        $this->commentObjectTypeResolver = $commentObjectTypeResolver;
    }
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    public final function setCommentByOneofInputObjectTypeResolver(CommentByOneofInputObjectTypeResolver $commentByOneofInputObjectTypeResolver) : void
    {
        $this->commentByOneofInputObjectTypeResolver = $commentByOneofInputObjectTypeResolver;
    }
    protected final function getCommentByOneofInputObjectTypeResolver() : CommentByOneofInputObjectTypeResolver
    {
        if ($this->commentByOneofInputObjectTypeResolver === null) {
            /** @var CommentByOneofInputObjectTypeResolver */
            $commentByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(CommentByOneofInputObjectTypeResolver::class);
            $this->commentByOneofInputObjectTypeResolver = $commentByOneofInputObjectTypeResolver;
        }
        return $this->commentByOneofInputObjectTypeResolver;
    }
    public final function setRootMyCommentsFilterInputObjectTypeResolver(RootMyCommentsFilterInputObjectTypeResolver $rootMyCommentsFilterInputObjectTypeResolver) : void
    {
        $this->rootMyCommentsFilterInputObjectTypeResolver = $rootMyCommentsFilterInputObjectTypeResolver;
    }
    protected final function getRootMyCommentsFilterInputObjectTypeResolver() : RootMyCommentsFilterInputObjectTypeResolver
    {
        if ($this->rootMyCommentsFilterInputObjectTypeResolver === null) {
            /** @var RootMyCommentsFilterInputObjectTypeResolver */
            $rootMyCommentsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(RootMyCommentsFilterInputObjectTypeResolver::class);
            $this->rootMyCommentsFilterInputObjectTypeResolver = $rootMyCommentsFilterInputObjectTypeResolver;
        }
        return $this->rootMyCommentsFilterInputObjectTypeResolver;
    }
    public final function setRootCommentPaginationInputObjectTypeResolver(RootCommentPaginationInputObjectTypeResolver $rootCommentPaginationInputObjectTypeResolver) : void
    {
        $this->rootCommentPaginationInputObjectTypeResolver = $rootCommentPaginationInputObjectTypeResolver;
    }
    protected final function getRootCommentPaginationInputObjectTypeResolver() : RootCommentPaginationInputObjectTypeResolver
    {
        if ($this->rootCommentPaginationInputObjectTypeResolver === null) {
            /** @var RootCommentPaginationInputObjectTypeResolver */
            $rootCommentPaginationInputObjectTypeResolver = $this->instanceManager->getInstance(RootCommentPaginationInputObjectTypeResolver::class);
            $this->rootCommentPaginationInputObjectTypeResolver = $rootCommentPaginationInputObjectTypeResolver;
        }
        return $this->rootCommentPaginationInputObjectTypeResolver;
    }
    public final function setCommentSortInputObjectTypeResolver(CommentSortInputObjectTypeResolver $commentSortInputObjectTypeResolver) : void
    {
        $this->commentSortInputObjectTypeResolver = $commentSortInputObjectTypeResolver;
    }
    protected final function getCommentSortInputObjectTypeResolver() : CommentSortInputObjectTypeResolver
    {
        if ($this->commentSortInputObjectTypeResolver === null) {
            /** @var CommentSortInputObjectTypeResolver */
            $commentSortInputObjectTypeResolver = $this->instanceManager->getInstance(CommentSortInputObjectTypeResolver::class);
            $this->commentSortInputObjectTypeResolver = $commentSortInputObjectTypeResolver;
        }
        return $this->commentSortInputObjectTypeResolver;
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
        return ['myComment', 'myCommentCount', 'myComments'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'myCommentCount':
                return $this->getIntScalarTypeResolver();
            case 'myComments':
            case 'myComment':
                return $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'myCommentCount':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'myComments':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'myComment':
                return $this->__('Comment by the logged-in user on the site with a specific ID', 'pop-comments');
            case 'myCommentCount':
                return $this->__('Number of comments by the logged-in user on the site', 'pop-comments');
            case 'myComments':
                return $this->__('Comments by the logged-in user on the site', 'pop-comments');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component
    {
        switch ($fieldName) {
            case 'myComment':
                return new Component(SingleCommentFilterInputContainerComponentProcessor::class, SingleCommentFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_COMMENT_STATUS);
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
            case 'myComment':
                return \array_merge($fieldArgNameTypeResolvers, ['by' => $this->getCommentByOneofInputObjectTypeResolver()]);
            case 'myComments':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyCommentsFilterInputObjectTypeResolver(), 'pagination' => $this->getRootCommentPaginationInputObjectTypeResolver(), 'sort' => $this->getCommentSortInputObjectTypeResolver()]);
            case 'myCommentCount':
                return \array_merge($fieldArgNameTypeResolvers, ['filter' => $this->getRootMyCommentsFilterInputObjectTypeResolver()]);
            default:
                return $fieldArgNameTypeResolvers;
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['myComment' => 'by']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $query = \array_merge($this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor), ['authors' => [App::getState('current-user-id')]]);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'myCommentCount':
                return $this->getCommentTypeAPI()->getCommentCount($query);
            case 'myComments':
                return $this->getCommentTypeAPI()->getComments($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'myComment':
                if ($comments = $this->getCommentTypeAPI()->getComments($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $comments[0];
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
