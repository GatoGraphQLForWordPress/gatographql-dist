<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\Module;
use PoPCMSSchema\CategoryMutations\ModuleConfiguration;
use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermMutationResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootCreatePostCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootDeletePostCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootUpdatePostCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootCreatePostCategoryTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver;
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
class RootPostCategoryCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver|null
     */
    private $postCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootCreatePostCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootCreatePostCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver|null
     */
    private $createPostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermBulkOperationMutationResolver|null
     */
    private $createPostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver|null
     */
    private $deletePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermBulkOperationMutationResolver|null
     */
    private $deletePostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermMutationResolver|null
     */
    private $updatePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\UpdatePostCategoryTermBulkOperationMutationResolver|null
     */
    private $updatePostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver|null
     */
    private $payloadableDeletePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableDeletePostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver|null
     */
    private $payloadableUpdatePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableUpdatePostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver|null
     */
    private $payloadableCreatePostCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableCreatePostCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootDeletePostCategoryTermInputObjectTypeResolver|null
     */
    private $rootDeletePostCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootUpdatePostCategoryTermInputObjectTypeResolver|null
     */
    private $rootUpdatePostCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\RootCreatePostCategoryTermInputObjectTypeResolver|null
     */
    private $rootCreatePostCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    public final function setPostCategoryObjectTypeResolver(PostCategoryObjectTypeResolver $postCategoryObjectTypeResolver) : void
    {
        $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
    }
    protected final function getPostCategoryObjectTypeResolver() : PostCategoryObjectTypeResolver
    {
        if ($this->postCategoryObjectTypeResolver === null) {
            /** @var PostCategoryObjectTypeResolver */
            $postCategoryObjectTypeResolver = $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
            $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
        }
        return $this->postCategoryObjectTypeResolver;
    }
    public final function setRootDeletePostCategoryTermMutationPayloadObjectTypeResolver(RootDeletePostCategoryTermMutationPayloadObjectTypeResolver $rootDeletePostCategoryTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootDeletePostCategoryTermMutationPayloadObjectTypeResolver = $rootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootDeletePostCategoryTermMutationPayloadObjectTypeResolver() : RootDeletePostCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeletePostCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeletePostCategoryTermMutationPayloadObjectTypeResolver */
            $rootDeletePostCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootDeletePostCategoryTermMutationPayloadObjectTypeResolver = $rootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    public final function setRootUpdatePostCategoryTermMutationPayloadObjectTypeResolver(RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver $rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver = $rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdatePostCategoryTermMutationPayloadObjectTypeResolver() : RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver */
            $rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver = $rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdatePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    public final function setRootCreatePostCategoryTermMutationPayloadObjectTypeResolver(RootCreatePostCategoryTermMutationPayloadObjectTypeResolver $rootCreatePostCategoryTermMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreatePostCategoryTermMutationPayloadObjectTypeResolver = $rootCreatePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreatePostCategoryTermMutationPayloadObjectTypeResolver() : RootCreatePostCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreatePostCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreatePostCategoryTermMutationPayloadObjectTypeResolver */
            $rootCreatePostCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootCreatePostCategoryTermMutationPayloadObjectTypeResolver = $rootCreatePostCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreatePostCategoryTermMutationPayloadObjectTypeResolver;
    }
    public final function setCreatePostCategoryTermMutationResolver(CreatePostCategoryTermMutationResolver $createPostCategoryTermMutationResolver) : void
    {
        $this->createPostCategoryTermMutationResolver = $createPostCategoryTermMutationResolver;
    }
    protected final function getCreatePostCategoryTermMutationResolver() : CreatePostCategoryTermMutationResolver
    {
        if ($this->createPostCategoryTermMutationResolver === null) {
            /** @var CreatePostCategoryTermMutationResolver */
            $createPostCategoryTermMutationResolver = $this->instanceManager->getInstance(CreatePostCategoryTermMutationResolver::class);
            $this->createPostCategoryTermMutationResolver = $createPostCategoryTermMutationResolver;
        }
        return $this->createPostCategoryTermMutationResolver;
    }
    public final function setCreatePostCategoryTermBulkOperationMutationResolver(CreatePostCategoryTermBulkOperationMutationResolver $createPostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->createPostCategoryTermBulkOperationMutationResolver = $createPostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getCreatePostCategoryTermBulkOperationMutationResolver() : CreatePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->createPostCategoryTermBulkOperationMutationResolver === null) {
            /** @var CreatePostCategoryTermBulkOperationMutationResolver */
            $createPostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(CreatePostCategoryTermBulkOperationMutationResolver::class);
            $this->createPostCategoryTermBulkOperationMutationResolver = $createPostCategoryTermBulkOperationMutationResolver;
        }
        return $this->createPostCategoryTermBulkOperationMutationResolver;
    }
    public final function setDeletePostCategoryTermMutationResolver(DeletePostCategoryTermMutationResolver $deletePostCategoryTermMutationResolver) : void
    {
        $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
    }
    protected final function getDeletePostCategoryTermMutationResolver() : DeletePostCategoryTermMutationResolver
    {
        if ($this->deletePostCategoryTermMutationResolver === null) {
            /** @var DeletePostCategoryTermMutationResolver */
            $deletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(DeletePostCategoryTermMutationResolver::class);
            $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
        }
        return $this->deletePostCategoryTermMutationResolver;
    }
    public final function setDeletePostCategoryTermBulkOperationMutationResolver(DeletePostCategoryTermBulkOperationMutationResolver $deletePostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->deletePostCategoryTermBulkOperationMutationResolver = $deletePostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getDeletePostCategoryTermBulkOperationMutationResolver() : DeletePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->deletePostCategoryTermBulkOperationMutationResolver === null) {
            /** @var DeletePostCategoryTermBulkOperationMutationResolver */
            $deletePostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(DeletePostCategoryTermBulkOperationMutationResolver::class);
            $this->deletePostCategoryTermBulkOperationMutationResolver = $deletePostCategoryTermBulkOperationMutationResolver;
        }
        return $this->deletePostCategoryTermBulkOperationMutationResolver;
    }
    public final function setUpdatePostCategoryTermMutationResolver(UpdatePostCategoryTermMutationResolver $updatePostCategoryTermMutationResolver) : void
    {
        $this->updatePostCategoryTermMutationResolver = $updatePostCategoryTermMutationResolver;
    }
    protected final function getUpdatePostCategoryTermMutationResolver() : UpdatePostCategoryTermMutationResolver
    {
        if ($this->updatePostCategoryTermMutationResolver === null) {
            /** @var UpdatePostCategoryTermMutationResolver */
            $updatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(UpdatePostCategoryTermMutationResolver::class);
            $this->updatePostCategoryTermMutationResolver = $updatePostCategoryTermMutationResolver;
        }
        return $this->updatePostCategoryTermMutationResolver;
    }
    public final function setUpdatePostCategoryTermBulkOperationMutationResolver(UpdatePostCategoryTermBulkOperationMutationResolver $updatePostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->updatePostCategoryTermBulkOperationMutationResolver = $updatePostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getUpdatePostCategoryTermBulkOperationMutationResolver() : UpdatePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->updatePostCategoryTermBulkOperationMutationResolver === null) {
            /** @var UpdatePostCategoryTermBulkOperationMutationResolver */
            $updatePostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdatePostCategoryTermBulkOperationMutationResolver::class);
            $this->updatePostCategoryTermBulkOperationMutationResolver = $updatePostCategoryTermBulkOperationMutationResolver;
        }
        return $this->updatePostCategoryTermBulkOperationMutationResolver;
    }
    public final function setPayloadableDeletePostCategoryTermMutationResolver(PayloadableDeletePostCategoryTermMutationResolver $payloadableDeletePostCategoryTermMutationResolver) : void
    {
        $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableDeletePostCategoryTermMutationResolver() : PayloadableDeletePostCategoryTermMutationResolver
    {
        if ($this->payloadableDeletePostCategoryTermMutationResolver === null) {
            /** @var PayloadableDeletePostCategoryTermMutationResolver */
            $payloadableDeletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostCategoryTermMutationResolver::class);
            $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
        }
        return $this->payloadableDeletePostCategoryTermMutationResolver;
    }
    public final function setPayloadableDeletePostCategoryTermBulkOperationMutationResolver(PayloadableDeletePostCategoryTermBulkOperationMutationResolver $payloadableDeletePostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->payloadableDeletePostCategoryTermBulkOperationMutationResolver = $payloadableDeletePostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeletePostCategoryTermBulkOperationMutationResolver() : PayloadableDeletePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableDeletePostCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableDeletePostCategoryTermBulkOperationMutationResolver */
            $payloadableDeletePostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeletePostCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableDeletePostCategoryTermBulkOperationMutationResolver = $payloadableDeletePostCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableDeletePostCategoryTermBulkOperationMutationResolver;
    }
    public final function setPayloadableUpdatePostCategoryTermMutationResolver(PayloadableUpdatePostCategoryTermMutationResolver $payloadableUpdatePostCategoryTermMutationResolver) : void
    {
        $this->payloadableUpdatePostCategoryTermMutationResolver = $payloadableUpdatePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableUpdatePostCategoryTermMutationResolver() : PayloadableUpdatePostCategoryTermMutationResolver
    {
        if ($this->payloadableUpdatePostCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdatePostCategoryTermMutationResolver */
            $payloadableUpdatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostCategoryTermMutationResolver::class);
            $this->payloadableUpdatePostCategoryTermMutationResolver = $payloadableUpdatePostCategoryTermMutationResolver;
        }
        return $this->payloadableUpdatePostCategoryTermMutationResolver;
    }
    public final function setPayloadableUpdatePostCategoryTermBulkOperationMutationResolver(PayloadableUpdatePostCategoryTermBulkOperationMutationResolver $payloadableUpdatePostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->payloadableUpdatePostCategoryTermBulkOperationMutationResolver = $payloadableUpdatePostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdatePostCategoryTermBulkOperationMutationResolver() : PayloadableUpdatePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableUpdatePostCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdatePostCategoryTermBulkOperationMutationResolver */
            $payloadableUpdatePostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdatePostCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableUpdatePostCategoryTermBulkOperationMutationResolver = $payloadableUpdatePostCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableUpdatePostCategoryTermBulkOperationMutationResolver;
    }
    public final function setPayloadableCreatePostCategoryTermMutationResolver(PayloadableCreatePostCategoryTermMutationResolver $payloadableCreatePostCategoryTermMutationResolver) : void
    {
        $this->payloadableCreatePostCategoryTermMutationResolver = $payloadableCreatePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableCreatePostCategoryTermMutationResolver() : PayloadableCreatePostCategoryTermMutationResolver
    {
        if ($this->payloadableCreatePostCategoryTermMutationResolver === null) {
            /** @var PayloadableCreatePostCategoryTermMutationResolver */
            $payloadableCreatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostCategoryTermMutationResolver::class);
            $this->payloadableCreatePostCategoryTermMutationResolver = $payloadableCreatePostCategoryTermMutationResolver;
        }
        return $this->payloadableCreatePostCategoryTermMutationResolver;
    }
    public final function setPayloadableCreatePostCategoryTermBulkOperationMutationResolver(PayloadableCreatePostCategoryTermBulkOperationMutationResolver $payloadableCreatePostCategoryTermBulkOperationMutationResolver) : void
    {
        $this->payloadableCreatePostCategoryTermBulkOperationMutationResolver = $payloadableCreatePostCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreatePostCategoryTermBulkOperationMutationResolver() : PayloadableCreatePostCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableCreatePostCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableCreatePostCategoryTermBulkOperationMutationResolver */
            $payloadableCreatePostCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreatePostCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableCreatePostCategoryTermBulkOperationMutationResolver = $payloadableCreatePostCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableCreatePostCategoryTermBulkOperationMutationResolver;
    }
    public final function setRootDeletePostCategoryTermInputObjectTypeResolver(RootDeletePostCategoryTermInputObjectTypeResolver $rootDeletePostCategoryTermInputObjectTypeResolver) : void
    {
        $this->rootDeletePostCategoryTermInputObjectTypeResolver = $rootDeletePostCategoryTermInputObjectTypeResolver;
    }
    protected final function getRootDeletePostCategoryTermInputObjectTypeResolver() : RootDeletePostCategoryTermInputObjectTypeResolver
    {
        if ($this->rootDeletePostCategoryTermInputObjectTypeResolver === null) {
            /** @var RootDeletePostCategoryTermInputObjectTypeResolver */
            $rootDeletePostCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermInputObjectTypeResolver::class);
            $this->rootDeletePostCategoryTermInputObjectTypeResolver = $rootDeletePostCategoryTermInputObjectTypeResolver;
        }
        return $this->rootDeletePostCategoryTermInputObjectTypeResolver;
    }
    public final function setRootUpdatePostCategoryTermInputObjectTypeResolver(RootUpdatePostCategoryTermInputObjectTypeResolver $rootUpdatePostCategoryTermInputObjectTypeResolver) : void
    {
        $this->rootUpdatePostCategoryTermInputObjectTypeResolver = $rootUpdatePostCategoryTermInputObjectTypeResolver;
    }
    protected final function getRootUpdatePostCategoryTermInputObjectTypeResolver() : RootUpdatePostCategoryTermInputObjectTypeResolver
    {
        if ($this->rootUpdatePostCategoryTermInputObjectTypeResolver === null) {
            /** @var RootUpdatePostCategoryTermInputObjectTypeResolver */
            $rootUpdatePostCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdatePostCategoryTermInputObjectTypeResolver::class);
            $this->rootUpdatePostCategoryTermInputObjectTypeResolver = $rootUpdatePostCategoryTermInputObjectTypeResolver;
        }
        return $this->rootUpdatePostCategoryTermInputObjectTypeResolver;
    }
    public final function setRootCreatePostCategoryTermInputObjectTypeResolver(RootCreatePostCategoryTermInputObjectTypeResolver $rootCreatePostCategoryTermInputObjectTypeResolver) : void
    {
        $this->rootCreatePostCategoryTermInputObjectTypeResolver = $rootCreatePostCategoryTermInputObjectTypeResolver;
    }
    protected final function getRootCreatePostCategoryTermInputObjectTypeResolver() : RootCreatePostCategoryTermInputObjectTypeResolver
    {
        if ($this->rootCreatePostCategoryTermInputObjectTypeResolver === null) {
            /** @var RootCreatePostCategoryTermInputObjectTypeResolver */
            $rootCreatePostCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreatePostCategoryTermInputObjectTypeResolver::class);
            $this->rootCreatePostCategoryTermInputObjectTypeResolver = $rootCreatePostCategoryTermInputObjectTypeResolver;
        }
        return $this->rootCreatePostCategoryTermInputObjectTypeResolver;
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
        $addFieldsToQueryPayloadableCategoryMutations = $moduleConfiguration->addFieldsToQueryPayloadableCategoryMutations();
        return \array_merge(['createPostCategory', 'createPostCategories'], !$disableRedundantRootTypeMutationFields ? ['updatePostCategory', 'updatePostCategories', 'deletePostCategory', 'deletePostCategories'] : [], $addFieldsToQueryPayloadableCategoryMutations ? ['createPostCategoryMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableCategoryMutations && !$disableRedundantRootTypeMutationFields ? ['updatePostCategoryMutationPayloadObjects', 'deletePostCategoryMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createPostCategory':
                return $this->__('Create a post category', 'category-mutations');
            case 'createPostCategories':
                return $this->__('Create post categories', 'category-mutations');
            case 'updatePostCategory':
                return $this->__('Update a post category', 'category-mutations');
            case 'updatePostCategories':
                return $this->__('Update post categories', 'category-mutations');
            case 'deletePostCategory':
                return $this->__('Delete a post category', 'category-mutations');
            case 'deletePostCategories':
                return $this->__('Delete post categories', 'category-mutations');
            case 'createPostCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createPostCategory` mutation', 'category-mutations');
            case 'updatePostCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updatePostCategory` mutation', 'category-mutations');
            case 'deletePostCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deletePostCategory` mutation', 'category-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if (!$usePayloadableCategoryMutations) {
            switch ($fieldName) {
                case 'createPostCategory':
                case 'updatePostCategory':
                case 'deletePostCategory':
                    return SchemaTypeModifiers::NONE;
                case 'createPostCategories':
                case 'updatePostCategories':
                case 'deletePostCategories':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createPostCategoryMutationPayloadObjects', 'updatePostCategoryMutationPayloadObjects', 'deletePostCategoryMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createPostCategory':
            case 'updatePostCategory':
            case 'deletePostCategory':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createPostCategories':
            case 'updatePostCategories':
            case 'deletePostCategories':
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
            case 'createPostCategory':
                return ['input' => $this->getRootCreatePostCategoryTermInputObjectTypeResolver()];
            case 'createPostCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreatePostCategoryTermInputObjectTypeResolver());
            case 'updatePostCategory':
                return ['input' => $this->getRootUpdatePostCategoryTermInputObjectTypeResolver()];
            case 'updatePostCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdatePostCategoryTermInputObjectTypeResolver());
            case 'deletePostCategory':
                return ['input' => $this->getRootDeletePostCategoryTermInputObjectTypeResolver()];
            case 'deletePostCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeletePostCategoryTermInputObjectTypeResolver());
            case 'createPostCategoryMutationPayloadObjects':
            case 'updatePostCategoryMutationPayloadObjects':
            case 'deletePostCategoryMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createPostCategoryMutationPayloadObjects', 'updatePostCategoryMutationPayloadObjects', 'deletePostCategoryMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createPostCategories', 'updatePostCategories', 'deletePostCategories'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createPostCategory' => 'input']:
            case ['updatePostCategory' => 'input']:
            case ['deletePostCategory' => 'input']:
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
        if (\in_array($fieldName, ['createPostCategories', 'updatePostCategories', 'deletePostCategories'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        switch ($fieldName) {
            case 'createPostCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableCreatePostCategoryTermMutationResolver() : $this->getCreatePostCategoryTermMutationResolver();
            case 'createPostCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableCreatePostCategoryTermBulkOperationMutationResolver() : $this->getCreatePostCategoryTermBulkOperationMutationResolver();
            case 'updatePostCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdatePostCategoryTermMutationResolver() : $this->getUpdatePostCategoryTermMutationResolver();
            case 'updatePostCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdatePostCategoryTermBulkOperationMutationResolver() : $this->getUpdatePostCategoryTermBulkOperationMutationResolver();
            case 'deletePostCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeletePostCategoryTermMutationResolver() : $this->getDeletePostCategoryTermMutationResolver();
            case 'deletePostCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeletePostCategoryTermBulkOperationMutationResolver() : $this->getDeletePostCategoryTermBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if ($usePayloadableCategoryMutations) {
            switch ($fieldName) {
                case 'createPostCategory':
                case 'createPostCategories':
                case 'createPostCategoryMutationPayloadObjects':
                    return $this->getRootCreatePostCategoryTermMutationPayloadObjectTypeResolver();
                case 'updatePostCategory':
                case 'updatePostCategories':
                case 'updatePostCategoryMutationPayloadObjects':
                    return $this->getRootUpdatePostCategoryTermMutationPayloadObjectTypeResolver();
                case 'deletePostCategory':
                case 'deletePostCategories':
                case 'deletePostCategoryMutationPayloadObjects':
                    return $this->getRootDeletePostCategoryTermMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createPostCategory':
            case 'createPostCategories':
            case 'updatePostCategory':
            case 'updatePostCategories':
                return $this->getPostCategoryObjectTypeResolver();
            case 'deletePostCategory':
            case 'deletePostCategories':
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
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if ($usePayloadableCategoryMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createPostCategory':
            case 'createPostCategories':
            case 'updatePostCategory':
            case 'updatePostCategories':
            case 'deletePostCategory':
            case 'deletePostCategories':
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
            case 'createPostCategoryMutationPayloadObjects':
            case 'updatePostCategoryMutationPayloadObjects':
            case 'deletePostCategoryMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
