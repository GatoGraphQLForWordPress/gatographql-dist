<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\Module;
use PoPCMSSchema\TagMutations\ModuleConfiguration;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermBulkOperationMutationResolver;
use PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootCreatePostTagTermInputObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootDeletePostTagTermInputObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootUpdatePostTagTermInputObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootCreatePostTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootUpdatePostTagTermMutationPayloadObjectTypeResolver;
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
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
/** @internal */
class RootPostTagCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver|null
     */
    private $postTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePostTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootUpdatePostTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootCreatePostTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootCreatePostTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermMutationResolver|null
     */
    private $createPostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermBulkOperationMutationResolver|null
     */
    private $createPostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermMutationResolver|null
     */
    private $deletePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\DeletePostTagTermBulkOperationMutationResolver|null
     */
    private $deletePostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver|null
     */
    private $updatePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermBulkOperationMutationResolver|null
     */
    private $updatePostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver|null
     */
    private $payloadableDeletePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermBulkOperationMutationResolver|null
     */
    private $payloadableDeletePostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver|null
     */
    private $payloadableUpdatePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermBulkOperationMutationResolver|null
     */
    private $payloadableUpdatePostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermMutationResolver|null
     */
    private $payloadableCreatePostTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermBulkOperationMutationResolver|null
     */
    private $payloadableCreatePostTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootDeletePostTagTermInputObjectTypeResolver|null
     */
    private $rootDeletePostTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootUpdatePostTagTermInputObjectTypeResolver|null
     */
    private $rootUpdatePostTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\RootCreatePostTagTermInputObjectTypeResolver|null
     */
    private $rootCreatePostTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    public final function setPostTagObjectTypeResolver(PostTagObjectTypeResolver $postTagObjectTypeResolver) : void
    {
        $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
    }
    protected final function getPostTagObjectTypeResolver() : PostTagObjectTypeResolver
    {
        if ($this->postTagObjectTypeResolver === null) {
            /** @var PostTagObjectTypeResolver */
            $postTagObjectTypeResolver = $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
            $this->postTagObjectTypeResolver = $postTagObjectTypeResolver;
        }
        return $this->postTagObjectTypeResolver;
    }
    public final function setRootDeletePostTagTermMutationPayloadObjectTypeResolver(RootDeletePostTagTermMutationPayloadObjectTypeResolver $rootDeletePostTagTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootDeletePostTagTermMutationPayloadObjectTypeResolver = $rootDeletePostTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootDeletePostTagTermMutationPayloadObjectTypeResolver() : RootDeletePostTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePostTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePostTagTermMutationPayloadObjectTypeResolver */
            $rootDeletePostTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePostTagTermMutationPayloadObjectTypeResolver = $rootDeletePostTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePostTagTermMutationPayloadObjectTypeResolver;
    }
    public final function setRootUpdatePostTagTermMutationPayloadObjectTypeResolver(RootUpdatePostTagTermMutationPayloadObjectTypeResolver $rootUpdatePostTagTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdatePostTagTermMutationPayloadObjectTypeResolver = $rootUpdatePostTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostTagTermMutationPayloadObjectTypeResolver() : RootUpdatePostTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostTagTermMutationPayloadObjectTypeResolver */
            $rootUpdatePostTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostTagTermMutationPayloadObjectTypeResolver = $rootUpdatePostTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostTagTermMutationPayloadObjectTypeResolver;
    }
    public final function setRootCreatePostTagTermMutationPayloadObjectTypeResolver(RootCreatePostTagTermMutationPayloadObjectTypeResolver $rootCreatePostTagTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreatePostTagTermMutationPayloadObjectTypeResolver = $rootCreatePostTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreatePostTagTermMutationPayloadObjectTypeResolver() : RootCreatePostTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreatePostTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreatePostTagTermMutationPayloadObjectTypeResolver */
            $rootCreatePostTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootCreatePostTagTermMutationPayloadObjectTypeResolver = $rootCreatePostTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreatePostTagTermMutationPayloadObjectTypeResolver;
    }
    public final function setCreatePostTagTermMutationResolver(CreatePostTagTermMutationResolver $createPostTagTermMutationResolver) : void
    {
        $this->createPostTagTermMutationResolver = $createPostTagTermMutationResolver;
    }
    protected final function getCreatePostTagTermMutationResolver() : CreatePostTagTermMutationResolver
    {
        if ($this->createPostTagTermMutationResolver === null) {
            /** @var CreatePostTagTermMutationResolver */
            $createPostTagTermMutationResolver = $this->instanceManager->getInstance(CreatePostTagTermMutationResolver::class);
            $this->createPostTagTermMutationResolver = $createPostTagTermMutationResolver;
        }
        return $this->createPostTagTermMutationResolver;
    }
    public final function setCreatePostTagTermBulkOperationMutationResolver(CreatePostTagTermBulkOperationMutationResolver $createPostTagTermBulkOperationMutationResolver) : void
    {
        $this->createPostTagTermBulkOperationMutationResolver = $createPostTagTermBulkOperationMutationResolver;
    }
    protected final function getCreatePostTagTermBulkOperationMutationResolver() : CreatePostTagTermBulkOperationMutationResolver
    {
        if ($this->createPostTagTermBulkOperationMutationResolver === null) {
            /** @var CreatePostTagTermBulkOperationMutationResolver */
            $createPostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(CreatePostTagTermBulkOperationMutationResolver::class);
            $this->createPostTagTermBulkOperationMutationResolver = $createPostTagTermBulkOperationMutationResolver;
        }
        return $this->createPostTagTermBulkOperationMutationResolver;
    }
    public final function setDeletePostTagTermMutationResolver(DeletePostTagTermMutationResolver $deletePostTagTermMutationResolver) : void
    {
        $this->deletePostTagTermMutationResolver = $deletePostTagTermMutationResolver;
    }
    protected final function getDeletePostTagTermMutationResolver() : DeletePostTagTermMutationResolver
    {
        if ($this->deletePostTagTermMutationResolver === null) {
            /** @var DeletePostTagTermMutationResolver */
            $deletePostTagTermMutationResolver = $this->instanceManager->getInstance(DeletePostTagTermMutationResolver::class);
            $this->deletePostTagTermMutationResolver = $deletePostTagTermMutationResolver;
        }
        return $this->deletePostTagTermMutationResolver;
    }
    public final function setDeletePostTagTermBulkOperationMutationResolver(DeletePostTagTermBulkOperationMutationResolver $deletePostTagTermBulkOperationMutationResolver) : void
    {
        $this->deletePostTagTermBulkOperationMutationResolver = $deletePostTagTermBulkOperationMutationResolver;
    }
    protected final function getDeletePostTagTermBulkOperationMutationResolver() : DeletePostTagTermBulkOperationMutationResolver
    {
        if ($this->deletePostTagTermBulkOperationMutationResolver === null) {
            /** @var DeletePostTagTermBulkOperationMutationResolver */
            $deletePostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(DeletePostTagTermBulkOperationMutationResolver::class);
            $this->deletePostTagTermBulkOperationMutationResolver = $deletePostTagTermBulkOperationMutationResolver;
        }
        return $this->deletePostTagTermBulkOperationMutationResolver;
    }
    public final function setUpdatePostTagTermMutationResolver(UpdatePostTagTermMutationResolver $updatePostTagTermMutationResolver) : void
    {
        $this->updatePostTagTermMutationResolver = $updatePostTagTermMutationResolver;
    }
    protected final function getUpdatePostTagTermMutationResolver() : UpdatePostTagTermMutationResolver
    {
        if ($this->updatePostTagTermMutationResolver === null) {
            /** @var UpdatePostTagTermMutationResolver */
            $updatePostTagTermMutationResolver = $this->instanceManager->getInstance(UpdatePostTagTermMutationResolver::class);
            $this->updatePostTagTermMutationResolver = $updatePostTagTermMutationResolver;
        }
        return $this->updatePostTagTermMutationResolver;
    }
    public final function setUpdatePostTagTermBulkOperationMutationResolver(UpdatePostTagTermBulkOperationMutationResolver $updatePostTagTermBulkOperationMutationResolver) : void
    {
        $this->updatePostTagTermBulkOperationMutationResolver = $updatePostTagTermBulkOperationMutationResolver;
    }
    protected final function getUpdatePostTagTermBulkOperationMutationResolver() : UpdatePostTagTermBulkOperationMutationResolver
    {
        if ($this->updatePostTagTermBulkOperationMutationResolver === null) {
            /** @var UpdatePostTagTermBulkOperationMutationResolver */
            $updatePostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdatePostTagTermBulkOperationMutationResolver::class);
            $this->updatePostTagTermBulkOperationMutationResolver = $updatePostTagTermBulkOperationMutationResolver;
        }
        return $this->updatePostTagTermBulkOperationMutationResolver;
    }
    public final function setPayloadableDeletePostTagTermMutationResolver(PayloadableDeletePostTagTermMutationResolver $payloadableDeletePostTagTermMutationResolver) : void
    {
        $this->payloadableDeletePostTagTermMutationResolver = $payloadableDeletePostTagTermMutationResolver;
    }
    protected final function getPayloadableDeletePostTagTermMutationResolver() : PayloadableDeletePostTagTermMutationResolver
    {
        if ($this->payloadableDeletePostTagTermMutationResolver === null) {
            /** @var PayloadableDeletePostTagTermMutationResolver */
            $payloadableDeletePostTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostTagTermMutationResolver::class);
            $this->payloadableDeletePostTagTermMutationResolver = $payloadableDeletePostTagTermMutationResolver;
        }
        return $this->payloadableDeletePostTagTermMutationResolver;
    }
    public final function setPayloadableDeletePostTagTermBulkOperationMutationResolver(PayloadableDeletePostTagTermBulkOperationMutationResolver $payloadableDeletePostTagTermBulkOperationMutationResolver) : void
    {
        $this->payloadableDeletePostTagTermBulkOperationMutationResolver = $payloadableDeletePostTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeletePostTagTermBulkOperationMutationResolver() : PayloadableDeletePostTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableDeletePostTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableDeletePostTagTermBulkOperationMutationResolver */
            $payloadableDeletePostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostTagTermBulkOperationMutationResolver::class);
            $this->payloadableDeletePostTagTermBulkOperationMutationResolver = $payloadableDeletePostTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableDeletePostTagTermBulkOperationMutationResolver;
    }
    public final function setPayloadableUpdatePostTagTermMutationResolver(PayloadableUpdatePostTagTermMutationResolver $payloadableUpdatePostTagTermMutationResolver) : void
    {
        $this->payloadableUpdatePostTagTermMutationResolver = $payloadableUpdatePostTagTermMutationResolver;
    }
    protected final function getPayloadableUpdatePostTagTermMutationResolver() : PayloadableUpdatePostTagTermMutationResolver
    {
        if ($this->payloadableUpdatePostTagTermMutationResolver === null) {
            /** @var PayloadableUpdatePostTagTermMutationResolver */
            $payloadableUpdatePostTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostTagTermMutationResolver::class);
            $this->payloadableUpdatePostTagTermMutationResolver = $payloadableUpdatePostTagTermMutationResolver;
        }
        return $this->payloadableUpdatePostTagTermMutationResolver;
    }
    public final function setPayloadableUpdatePostTagTermBulkOperationMutationResolver(PayloadableUpdatePostTagTermBulkOperationMutationResolver $payloadableUpdatePostTagTermBulkOperationMutationResolver) : void
    {
        $this->payloadableUpdatePostTagTermBulkOperationMutationResolver = $payloadableUpdatePostTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdatePostTagTermBulkOperationMutationResolver() : PayloadableUpdatePostTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableUpdatePostTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdatePostTagTermBulkOperationMutationResolver */
            $payloadableUpdatePostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostTagTermBulkOperationMutationResolver::class);
            $this->payloadableUpdatePostTagTermBulkOperationMutationResolver = $payloadableUpdatePostTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableUpdatePostTagTermBulkOperationMutationResolver;
    }
    public final function setPayloadableCreatePostTagTermMutationResolver(PayloadableCreatePostTagTermMutationResolver $payloadableCreatePostTagTermMutationResolver) : void
    {
        $this->payloadableCreatePostTagTermMutationResolver = $payloadableCreatePostTagTermMutationResolver;
    }
    protected final function getPayloadableCreatePostTagTermMutationResolver() : PayloadableCreatePostTagTermMutationResolver
    {
        if ($this->payloadableCreatePostTagTermMutationResolver === null) {
            /** @var PayloadableCreatePostTagTermMutationResolver */
            $payloadableCreatePostTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostTagTermMutationResolver::class);
            $this->payloadableCreatePostTagTermMutationResolver = $payloadableCreatePostTagTermMutationResolver;
        }
        return $this->payloadableCreatePostTagTermMutationResolver;
    }
    public final function setPayloadableCreatePostTagTermBulkOperationMutationResolver(PayloadableCreatePostTagTermBulkOperationMutationResolver $payloadableCreatePostTagTermBulkOperationMutationResolver) : void
    {
        $this->payloadableCreatePostTagTermBulkOperationMutationResolver = $payloadableCreatePostTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreatePostTagTermBulkOperationMutationResolver() : PayloadableCreatePostTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableCreatePostTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableCreatePostTagTermBulkOperationMutationResolver */
            $payloadableCreatePostTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostTagTermBulkOperationMutationResolver::class);
            $this->payloadableCreatePostTagTermBulkOperationMutationResolver = $payloadableCreatePostTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableCreatePostTagTermBulkOperationMutationResolver;
    }
    public final function setRootDeletePostTagTermInputObjectTypeResolver(RootDeletePostTagTermInputObjectTypeResolver $rootDeletePostTagTermInputObjectTypeResolver) : void
    {
        $this->rootDeletePostTagTermInputObjectTypeResolver = $rootDeletePostTagTermInputObjectTypeResolver;
    }
    protected final function getRootDeletePostTagTermInputObjectTypeResolver() : RootDeletePostTagTermInputObjectTypeResolver
    {
        if ($this->rootDeletePostTagTermInputObjectTypeResolver === null) {
            /** @var RootDeletePostTagTermInputObjectTypeResolver */
            $rootDeletePostTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermInputObjectTypeResolver::class);
            $this->rootDeletePostTagTermInputObjectTypeResolver = $rootDeletePostTagTermInputObjectTypeResolver;
        }
        return $this->rootDeletePostTagTermInputObjectTypeResolver;
    }
    public final function setRootUpdatePostTagTermInputObjectTypeResolver(RootUpdatePostTagTermInputObjectTypeResolver $rootUpdatePostTagTermInputObjectTypeResolver) : void
    {
        $this->rootUpdatePostTagTermInputObjectTypeResolver = $rootUpdatePostTagTermInputObjectTypeResolver;
    }
    protected final function getRootUpdatePostTagTermInputObjectTypeResolver() : RootUpdatePostTagTermInputObjectTypeResolver
    {
        if ($this->rootUpdatePostTagTermInputObjectTypeResolver === null) {
            /** @var RootUpdatePostTagTermInputObjectTypeResolver */
            $rootUpdatePostTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermInputObjectTypeResolver::class);
            $this->rootUpdatePostTagTermInputObjectTypeResolver = $rootUpdatePostTagTermInputObjectTypeResolver;
        }
        return $this->rootUpdatePostTagTermInputObjectTypeResolver;
    }
    public final function setRootCreatePostTagTermInputObjectTypeResolver(RootCreatePostTagTermInputObjectTypeResolver $rootCreatePostTagTermInputObjectTypeResolver) : void
    {
        $this->rootCreatePostTagTermInputObjectTypeResolver = $rootCreatePostTagTermInputObjectTypeResolver;
    }
    protected final function getRootCreatePostTagTermInputObjectTypeResolver() : RootCreatePostTagTermInputObjectTypeResolver
    {
        if ($this->rootCreatePostTagTermInputObjectTypeResolver === null) {
            /** @var RootCreatePostTagTermInputObjectTypeResolver */
            $rootCreatePostTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostTagTermInputObjectTypeResolver::class);
            $this->rootCreatePostTagTermInputObjectTypeResolver = $rootCreatePostTagTermInputObjectTypeResolver;
        }
        return $this->rootCreatePostTagTermInputObjectTypeResolver;
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
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
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
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableTagMutations = $moduleConfiguration->addFieldsToQueryPayloadableTagMutations();
        return \array_merge(['createPostTag', 'createPostTags'], !$disableRedundantRootTypeMutationFields ? ['updatePostTag', 'updatePostTags', 'deletePostTag', 'deletePostTags'] : [], $addFieldsToQueryPayloadableTagMutations ? ['createPostTagMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableTagMutations && !$disableRedundantRootTypeMutationFields ? ['updatePostTagMutationPayloadObjects', 'deletePostTagMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createPostTag':
                return $this->__('Create a post tag', 'tag-mutations');
            case 'createPostTags':
                return $this->__('Create post tags', 'tag-mutations');
            case 'updatePostTag':
                return $this->__('Update a post tag', 'tag-mutations');
            case 'updatePostTags':
                return $this->__('Update post tags', 'tag-mutations');
            case 'deletePostTag':
                return $this->__('Delete a post tag', 'tag-mutations');
            case 'deletePostTags':
                return $this->__('Delete post tags', 'tag-mutations');
            case 'createPostTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createPostTag` mutation', 'tag-mutations');
            case 'updatePostTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updatePostTag` mutation', 'tag-mutations');
            case 'deletePostTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deletePostTag` mutation', 'tag-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if (!$usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'createPostTag':
                case 'updatePostTag':
                case 'deletePostTag':
                    return SchemaTypeModifiers::NONE;
                case 'createPostTags':
                case 'updatePostTags':
                case 'deletePostTags':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createPostTagMutationPayloadObjects', 'updatePostTagMutationPayloadObjects', 'deletePostTagMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createPostTag':
            case 'updatePostTag':
            case 'deletePostTag':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createPostTags':
            case 'updatePostTags':
            case 'deletePostTags':
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
            case 'createPostTag':
                return ['input' => $this->getRootCreatePostTagTermInputObjectTypeResolver()];
            case 'createPostTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreatePostTagTermInputObjectTypeResolver());
            case 'updatePostTag':
                return ['input' => $this->getRootUpdatePostTagTermInputObjectTypeResolver()];
            case 'updatePostTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdatePostTagTermInputObjectTypeResolver());
            case 'deletePostTag':
                return ['input' => $this->getRootDeletePostTagTermInputObjectTypeResolver()];
            case 'deletePostTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeletePostTagTermInputObjectTypeResolver());
            case 'createPostTagMutationPayloadObjects':
            case 'updatePostTagMutationPayloadObjects':
            case 'deletePostTagMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createPostTagMutationPayloadObjects', 'updatePostTagMutationPayloadObjects', 'deletePostTagMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createPostTags', 'updatePostTags', 'deletePostTags'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createPostTag' => 'input']:
            case ['updatePostTag' => 'input']:
            case ['deletePostTag' => 'input']:
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
        if (\in_array($fieldName, ['createPostTags', 'updatePostTags', 'deletePostTags'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        switch ($fieldName) {
            case 'createPostTag':
                return $usePayloadableTagMutations ? $this->getPayloadableCreatePostTagTermMutationResolver() : $this->getCreatePostTagTermMutationResolver();
            case 'createPostTags':
                return $usePayloadableTagMutations ? $this->getPayloadableCreatePostTagTermBulkOperationMutationResolver() : $this->getCreatePostTagTermBulkOperationMutationResolver();
            case 'updatePostTag':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdatePostTagTermMutationResolver() : $this->getUpdatePostTagTermMutationResolver();
            case 'updatePostTags':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdatePostTagTermBulkOperationMutationResolver() : $this->getUpdatePostTagTermBulkOperationMutationResolver();
            case 'deletePostTag':
                return $usePayloadableTagMutations ? $this->getPayloadableDeletePostTagTermMutationResolver() : $this->getDeletePostTagTermMutationResolver();
            case 'deletePostTags':
                return $usePayloadableTagMutations ? $this->getPayloadableDeletePostTagTermBulkOperationMutationResolver() : $this->getDeletePostTagTermBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if ($usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'createPostTag':
                case 'createPostTags':
                case 'createPostTagMutationPayloadObjects':
                    return $this->getRootCreatePostTagTermMutationPayloadObjectTypeResolver();
                case 'updatePostTag':
                case 'updatePostTags':
                case 'updatePostTagMutationPayloadObjects':
                    return $this->getRootUpdatePostTagTermMutationPayloadObjectTypeResolver();
                case 'deletePostTag':
                case 'deletePostTags':
                case 'deletePostTagMutationPayloadObjects':
                    return $this->getRootDeletePostTagTermMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createPostTag':
            case 'createPostTags':
            case 'updatePostTag':
            case 'updatePostTags':
                return $this->getPostTagObjectTypeResolver();
            case 'deletePostTag':
            case 'deletePostTags':
                return $this->getBooleanScalarTypeResolver();
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
         * @var ModuleConfiguration
         */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if ($usePayloadableTagMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createPostTag':
            case 'createPostTags':
            case 'updatePostTag':
            case 'updatePostTags':
            case 'deletePostTag':
            case 'deletePostTags':
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
            case 'createPostTagMutationPayloadObjects':
            case 'updatePostTagMutationPayloadObjects':
            case 'deletePostTagMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
