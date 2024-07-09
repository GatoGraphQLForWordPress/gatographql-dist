<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\Module as CustomPostMutationsModule;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration as CustomPostMutationsModuleConfiguration;
use PoPCMSSchema\PostMutations\MutationResolvers\CreatePostBulkOperationMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\CreatePostMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostBulkOperationMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostBulkOperationMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostBulkOperationMutationResolver;
use PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver;
use PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\RootCreatePostInputObjectTypeResolver;
use PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\RootUpdatePostInputObjectTypeResolver;
use PoPCMSSchema\PostMutations\TypeResolvers\ObjectType\RootCreatePostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostMutations\TypeResolvers\ObjectType\RootUpdatePostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
/** @internal */
class RootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver|null
     */
    private $postObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\ObjectType\RootUpdatePostMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\ObjectType\RootCreatePostMutationPayloadObjectTypeResolver|null
     */
    private $rootCreatePostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\CreatePostMutationResolver|null
     */
    private $createPostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\CreatePostBulkOperationMutationResolver|null
     */
    private $createPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver|null
     */
    private $updatePostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostBulkOperationMutationResolver|null
     */
    private $updatePostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostMutationResolver|null
     */
    private $payloadableUpdatePostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostBulkOperationMutationResolver|null
     */
    private $payloadableUpdatePostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostMutationResolver|null
     */
    private $payloadableCreatePostMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostBulkOperationMutationResolver|null
     */
    private $payloadableCreatePostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\RootUpdatePostInputObjectTypeResolver|null
     */
    private $rootUpdatePostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\InputObjectType\RootCreatePostInputObjectTypeResolver|null
     */
    private $rootCreatePostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
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
    public final function setRootUpdatePostMutationPayloadObjectTypeResolver(RootUpdatePostMutationPayloadObjectTypeResolver $rootUpdatePostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdatePostMutationPayloadObjectTypeResolver = $rootUpdatePostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostMutationPayloadObjectTypeResolver() : RootUpdatePostMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostMutationPayloadObjectTypeResolver */
            $rootUpdatePostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostMutationPayloadObjectTypeResolver = $rootUpdatePostMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostMutationPayloadObjectTypeResolver;
    }
    public final function setRootCreatePostMutationPayloadObjectTypeResolver(RootCreatePostMutationPayloadObjectTypeResolver $rootCreatePostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreatePostMutationPayloadObjectTypeResolver = $rootCreatePostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreatePostMutationPayloadObjectTypeResolver() : RootCreatePostMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreatePostMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreatePostMutationPayloadObjectTypeResolver */
            $rootCreatePostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostMutationPayloadObjectTypeResolver::class);
            $this->rootCreatePostMutationPayloadObjectTypeResolver = $rootCreatePostMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreatePostMutationPayloadObjectTypeResolver;
    }
    public final function setCreatePostMutationResolver(CreatePostMutationResolver $createPostMutationResolver) : void
    {
        $this->createPostMutationResolver = $createPostMutationResolver;
    }
    protected final function getCreatePostMutationResolver() : CreatePostMutationResolver
    {
        if ($this->createPostMutationResolver === null) {
            /** @var CreatePostMutationResolver */
            $createPostMutationResolver = $this->instanceManager->getInstance(CreatePostMutationResolver::class);
            $this->createPostMutationResolver = $createPostMutationResolver;
        }
        return $this->createPostMutationResolver;
    }
    public final function setCreatePostBulkOperationMutationResolver(CreatePostBulkOperationMutationResolver $createPostBulkOperationMutationResolver) : void
    {
        $this->createPostBulkOperationMutationResolver = $createPostBulkOperationMutationResolver;
    }
    protected final function getCreatePostBulkOperationMutationResolver() : CreatePostBulkOperationMutationResolver
    {
        if ($this->createPostBulkOperationMutationResolver === null) {
            /** @var CreatePostBulkOperationMutationResolver */
            $createPostBulkOperationMutationResolver = $this->instanceManager->getInstance(CreatePostBulkOperationMutationResolver::class);
            $this->createPostBulkOperationMutationResolver = $createPostBulkOperationMutationResolver;
        }
        return $this->createPostBulkOperationMutationResolver;
    }
    public final function setUpdatePostMutationResolver(UpdatePostMutationResolver $updatePostMutationResolver) : void
    {
        $this->updatePostMutationResolver = $updatePostMutationResolver;
    }
    protected final function getUpdatePostMutationResolver() : UpdatePostMutationResolver
    {
        if ($this->updatePostMutationResolver === null) {
            /** @var UpdatePostMutationResolver */
            $updatePostMutationResolver = $this->instanceManager->getInstance(UpdatePostMutationResolver::class);
            $this->updatePostMutationResolver = $updatePostMutationResolver;
        }
        return $this->updatePostMutationResolver;
    }
    public final function setUpdatePostBulkOperationMutationResolver(UpdatePostBulkOperationMutationResolver $updatePostBulkOperationMutationResolver) : void
    {
        $this->updatePostBulkOperationMutationResolver = $updatePostBulkOperationMutationResolver;
    }
    protected final function getUpdatePostBulkOperationMutationResolver() : UpdatePostBulkOperationMutationResolver
    {
        if ($this->updatePostBulkOperationMutationResolver === null) {
            /** @var UpdatePostBulkOperationMutationResolver */
            $updatePostBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdatePostBulkOperationMutationResolver::class);
            $this->updatePostBulkOperationMutationResolver = $updatePostBulkOperationMutationResolver;
        }
        return $this->updatePostBulkOperationMutationResolver;
    }
    public final function setPayloadableUpdatePostMutationResolver(PayloadableUpdatePostMutationResolver $payloadableUpdatePostMutationResolver) : void
    {
        $this->payloadableUpdatePostMutationResolver = $payloadableUpdatePostMutationResolver;
    }
    protected final function getPayloadableUpdatePostMutationResolver() : PayloadableUpdatePostMutationResolver
    {
        if ($this->payloadableUpdatePostMutationResolver === null) {
            /** @var PayloadableUpdatePostMutationResolver */
            $payloadableUpdatePostMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostMutationResolver::class);
            $this->payloadableUpdatePostMutationResolver = $payloadableUpdatePostMutationResolver;
        }
        return $this->payloadableUpdatePostMutationResolver;
    }
    public final function setPayloadableUpdatePostBulkOperationMutationResolver(PayloadableUpdatePostBulkOperationMutationResolver $payloadableUpdatePostBulkOperationMutationResolver) : void
    {
        $this->payloadableUpdatePostBulkOperationMutationResolver = $payloadableUpdatePostBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdatePostBulkOperationMutationResolver() : PayloadableUpdatePostBulkOperationMutationResolver
    {
        if ($this->payloadableUpdatePostBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdatePostBulkOperationMutationResolver */
            $payloadableUpdatePostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostBulkOperationMutationResolver::class);
            $this->payloadableUpdatePostBulkOperationMutationResolver = $payloadableUpdatePostBulkOperationMutationResolver;
        }
        return $this->payloadableUpdatePostBulkOperationMutationResolver;
    }
    public final function setPayloadableCreatePostMutationResolver(PayloadableCreatePostMutationResolver $payloadableCreatePostMutationResolver) : void
    {
        $this->payloadableCreatePostMutationResolver = $payloadableCreatePostMutationResolver;
    }
    protected final function getPayloadableCreatePostMutationResolver() : PayloadableCreatePostMutationResolver
    {
        if ($this->payloadableCreatePostMutationResolver === null) {
            /** @var PayloadableCreatePostMutationResolver */
            $payloadableCreatePostMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostMutationResolver::class);
            $this->payloadableCreatePostMutationResolver = $payloadableCreatePostMutationResolver;
        }
        return $this->payloadableCreatePostMutationResolver;
    }
    public final function setPayloadableCreatePostBulkOperationMutationResolver(PayloadableCreatePostBulkOperationMutationResolver $payloadableCreatePostBulkOperationMutationResolver) : void
    {
        $this->payloadableCreatePostBulkOperationMutationResolver = $payloadableCreatePostBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreatePostBulkOperationMutationResolver() : PayloadableCreatePostBulkOperationMutationResolver
    {
        if ($this->payloadableCreatePostBulkOperationMutationResolver === null) {
            /** @var PayloadableCreatePostBulkOperationMutationResolver */
            $payloadableCreatePostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostBulkOperationMutationResolver::class);
            $this->payloadableCreatePostBulkOperationMutationResolver = $payloadableCreatePostBulkOperationMutationResolver;
        }
        return $this->payloadableCreatePostBulkOperationMutationResolver;
    }
    public final function setRootUpdatePostInputObjectTypeResolver(RootUpdatePostInputObjectTypeResolver $rootUpdatePostInputObjectTypeResolver) : void
    {
        $this->rootUpdatePostInputObjectTypeResolver = $rootUpdatePostInputObjectTypeResolver;
    }
    protected final function getRootUpdatePostInputObjectTypeResolver() : RootUpdatePostInputObjectTypeResolver
    {
        if ($this->rootUpdatePostInputObjectTypeResolver === null) {
            /** @var RootUpdatePostInputObjectTypeResolver */
            $rootUpdatePostInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostInputObjectTypeResolver::class);
            $this->rootUpdatePostInputObjectTypeResolver = $rootUpdatePostInputObjectTypeResolver;
        }
        return $this->rootUpdatePostInputObjectTypeResolver;
    }
    public final function setRootCreatePostInputObjectTypeResolver(RootCreatePostInputObjectTypeResolver $rootCreatePostInputObjectTypeResolver) : void
    {
        $this->rootCreatePostInputObjectTypeResolver = $rootCreatePostInputObjectTypeResolver;
    }
    protected final function getRootCreatePostInputObjectTypeResolver() : RootCreatePostInputObjectTypeResolver
    {
        if ($this->rootCreatePostInputObjectTypeResolver === null) {
            /** @var RootCreatePostInputObjectTypeResolver */
            $rootCreatePostInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostInputObjectTypeResolver::class);
            $this->rootCreatePostInputObjectTypeResolver = $rootCreatePostInputObjectTypeResolver;
        }
        return $this->rootCreatePostInputObjectTypeResolver;
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
        /** @var EngineModuleConfiguration */
        $engineModuleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        $disableRedundantRootTypeMutationFields = $engineModuleConfiguration->disableRedundantRootTypeMutationFields();
        /** @var CustomPostMutationsModuleConfiguration */
        $customPostMutationsModuleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $addFieldsToQueryPayloadableCustomPostMutations = $customPostMutationsModuleConfiguration->addFieldsToQueryPayloadableCustomPostMutations();
        return \array_merge(['createPost', 'createPosts'], !$disableRedundantRootTypeMutationFields ? ['updatePost', 'updatePosts'] : [], $addFieldsToQueryPayloadableCustomPostMutations ? ['createPostMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableCustomPostMutations && !$disableRedundantRootTypeMutationFields ? ['updatePostMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createPost':
                return $this->__('Create a post', 'post-mutations');
            case 'createPosts':
                return $this->__('Create posts', 'post-mutations');
            case 'updatePost':
                return $this->__('Update a post', 'post-mutations');
            case 'updatePosts':
                return $this->__('Update posts', 'post-mutations');
            case 'createPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createPost` mutation', 'post-mutations');
            case 'updatePostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updatePost` mutation', 'post-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if (!$usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createPost':
                case 'updatePost':
                    return SchemaTypeModifiers::NONE;
                case 'createPosts':
                case 'updatePosts':
                    return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createPostMutationPayloadObjects', 'updatePostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createPost':
            case 'updatePost':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createPosts':
            case 'updatePosts':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'createPost':
                return ['input' => $this->getRootCreatePostInputObjectTypeResolver()];
            case 'createPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreatePostInputObjectTypeResolver());
            case 'updatePost':
                return ['input' => $this->getRootUpdatePostInputObjectTypeResolver()];
            case 'updatePosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdatePostInputObjectTypeResolver());
            case 'createPostMutationPayloadObjects':
            case 'updatePostMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createPostMutationPayloadObjects', 'updatePostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createPosts', 'updatePosts'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createPost' => 'input']:
            case ['updatePost' => 'input']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName)
    {
        if (\in_array($fieldName, ['createPosts', 'updatePosts'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'createPost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreatePostMutationResolver() : $this->getCreatePostMutationResolver();
            case 'createPosts':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreatePostBulkOperationMutationResolver() : $this->getCreatePostBulkOperationMutationResolver();
            case 'updatePost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdatePostMutationResolver() : $this->getUpdatePostMutationResolver();
            case 'updatePosts':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdatePostBulkOperationMutationResolver() : $this->getUpdatePostBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createPost':
                case 'createPosts':
                case 'createPostMutationPayloadObjects':
                    return $this->getRootCreatePostMutationPayloadObjectTypeResolver();
                case 'updatePost':
                case 'updatePosts':
                case 'updatePostMutationPayloadObjects':
                    return $this->getRootUpdatePostMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createPost':
            case 'createPosts':
            case 'updatePost':
            case 'updatePosts':
                return $this->getPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return CheckpointInterface[]
     */
    public function getValidationCheckpoints(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, object $object) : array
    {
        $validationCheckpoints = parent::getValidationCheckpoints($objectTypeResolver, $fieldDataAccessor, $object);
        /**
         * For Payloadable: The "User Logged-in" checkpoint validation is not added,
         * instead this validation is executed inside the mutation, so the error
         * shows up in the Payload
         *
         * @var CustomPostMutationsModuleConfiguration
         */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createPost':
            case 'createPosts':
            case 'updatePost':
            case 'updatePosts':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'createPostMutationPayloadObjects':
            case 'updatePostMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
