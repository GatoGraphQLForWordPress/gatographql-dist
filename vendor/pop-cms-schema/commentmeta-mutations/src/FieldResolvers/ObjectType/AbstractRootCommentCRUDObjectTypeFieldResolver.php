<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootAddCommentMetaInputObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootDeleteCommentMetaInputObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootSetCommentMetaInputObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootUpdateCommentMetaInputObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\Module;
use PoPCMSSchema\CommentMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaBulkOperationMutationResolver;
use PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaMutationResolver;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Module as EngineModule;
use PoP\Engine\ModuleConfiguration as EngineModuleConfiguration;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
/** @internal */
abstract class AbstractRootCommentCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaMutationResolver|null
     */
    private $addCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaBulkOperationMutationResolver|null
     */
    private $addCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaMutationResolver|null
     */
    private $deleteCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaBulkOperationMutationResolver|null
     */
    private $deleteCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolver|null
     */
    private $setCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaBulkOperationMutationResolver|null
     */
    private $setCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaMutationResolver|null
     */
    private $updateCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaBulkOperationMutationResolver|null
     */
    private $updateCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaMutationResolver|null
     */
    private $payloadableDeleteCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaBulkOperationMutationResolver|null
     */
    private $payloadableDeleteCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaMutationResolver|null
     */
    private $payloadableSetCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaBulkOperationMutationResolver|null
     */
    private $payloadableSetCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaMutationResolver|null
     */
    private $payloadableUpdateCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaBulkOperationMutationResolver|null
     */
    private $payloadableUpdateCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaMutationResolver|null
     */
    private $payloadableAddCommentMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaBulkOperationMutationResolver|null
     */
    private $payloadableAddCommentMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootDeleteCommentMetaInputObjectTypeResolver|null
     */
    private $rootDeleteCommentMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootSetCommentMetaInputObjectTypeResolver|null
     */
    private $rootSetCommentMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootUpdateCommentMetaInputObjectTypeResolver|null
     */
    private $rootUpdateCommentMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\InputObjectType\RootAddCommentMetaInputObjectTypeResolver|null
     */
    private $rootAddCommentMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getAddCommentMetaMutationResolver() : AddCommentMetaMutationResolver
    {
        if ($this->addCommentMetaMutationResolver === null) {
            /** @var AddCommentMetaMutationResolver */
            $addCommentMetaMutationResolver = $this->instanceManager->getInstance(AddCommentMetaMutationResolver::class);
            $this->addCommentMetaMutationResolver = $addCommentMetaMutationResolver;
        }
        return $this->addCommentMetaMutationResolver;
    }
    protected final function getAddCommentMetaBulkOperationMutationResolver() : AddCommentMetaBulkOperationMutationResolver
    {
        if ($this->addCommentMetaBulkOperationMutationResolver === null) {
            /** @var AddCommentMetaBulkOperationMutationResolver */
            $addCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(AddCommentMetaBulkOperationMutationResolver::class);
            $this->addCommentMetaBulkOperationMutationResolver = $addCommentMetaBulkOperationMutationResolver;
        }
        return $this->addCommentMetaBulkOperationMutationResolver;
    }
    protected final function getDeleteCommentMetaMutationResolver() : DeleteCommentMetaMutationResolver
    {
        if ($this->deleteCommentMetaMutationResolver === null) {
            /** @var DeleteCommentMetaMutationResolver */
            $deleteCommentMetaMutationResolver = $this->instanceManager->getInstance(DeleteCommentMetaMutationResolver::class);
            $this->deleteCommentMetaMutationResolver = $deleteCommentMetaMutationResolver;
        }
        return $this->deleteCommentMetaMutationResolver;
    }
    protected final function getDeleteCommentMetaBulkOperationMutationResolver() : DeleteCommentMetaBulkOperationMutationResolver
    {
        if ($this->deleteCommentMetaBulkOperationMutationResolver === null) {
            /** @var DeleteCommentMetaBulkOperationMutationResolver */
            $deleteCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteCommentMetaBulkOperationMutationResolver::class);
            $this->deleteCommentMetaBulkOperationMutationResolver = $deleteCommentMetaBulkOperationMutationResolver;
        }
        return $this->deleteCommentMetaBulkOperationMutationResolver;
    }
    protected final function getSetCommentMetaMutationResolver() : SetCommentMetaMutationResolver
    {
        if ($this->setCommentMetaMutationResolver === null) {
            /** @var SetCommentMetaMutationResolver */
            $setCommentMetaMutationResolver = $this->instanceManager->getInstance(SetCommentMetaMutationResolver::class);
            $this->setCommentMetaMutationResolver = $setCommentMetaMutationResolver;
        }
        return $this->setCommentMetaMutationResolver;
    }
    protected final function getSetCommentMetaBulkOperationMutationResolver() : SetCommentMetaBulkOperationMutationResolver
    {
        if ($this->setCommentMetaBulkOperationMutationResolver === null) {
            /** @var SetCommentMetaBulkOperationMutationResolver */
            $setCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(SetCommentMetaBulkOperationMutationResolver::class);
            $this->setCommentMetaBulkOperationMutationResolver = $setCommentMetaBulkOperationMutationResolver;
        }
        return $this->setCommentMetaBulkOperationMutationResolver;
    }
    protected final function getUpdateCommentMetaMutationResolver() : UpdateCommentMetaMutationResolver
    {
        if ($this->updateCommentMetaMutationResolver === null) {
            /** @var UpdateCommentMetaMutationResolver */
            $updateCommentMetaMutationResolver = $this->instanceManager->getInstance(UpdateCommentMetaMutationResolver::class);
            $this->updateCommentMetaMutationResolver = $updateCommentMetaMutationResolver;
        }
        return $this->updateCommentMetaMutationResolver;
    }
    protected final function getUpdateCommentMetaBulkOperationMutationResolver() : UpdateCommentMetaBulkOperationMutationResolver
    {
        if ($this->updateCommentMetaBulkOperationMutationResolver === null) {
            /** @var UpdateCommentMetaBulkOperationMutationResolver */
            $updateCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateCommentMetaBulkOperationMutationResolver::class);
            $this->updateCommentMetaBulkOperationMutationResolver = $updateCommentMetaBulkOperationMutationResolver;
        }
        return $this->updateCommentMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteCommentMetaMutationResolver() : PayloadableDeleteCommentMetaMutationResolver
    {
        if ($this->payloadableDeleteCommentMetaMutationResolver === null) {
            /** @var PayloadableDeleteCommentMetaMutationResolver */
            $payloadableDeleteCommentMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCommentMetaMutationResolver::class);
            $this->payloadableDeleteCommentMetaMutationResolver = $payloadableDeleteCommentMetaMutationResolver;
        }
        return $this->payloadableDeleteCommentMetaMutationResolver;
    }
    protected final function getPayloadableDeleteCommentMetaBulkOperationMutationResolver() : PayloadableDeleteCommentMetaBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteCommentMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteCommentMetaBulkOperationMutationResolver */
            $payloadableDeleteCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCommentMetaBulkOperationMutationResolver::class);
            $this->payloadableDeleteCommentMetaBulkOperationMutationResolver = $payloadableDeleteCommentMetaBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteCommentMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetCommentMetaMutationResolver() : PayloadableSetCommentMetaMutationResolver
    {
        if ($this->payloadableSetCommentMetaMutationResolver === null) {
            /** @var PayloadableSetCommentMetaMutationResolver */
            $payloadableSetCommentMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetCommentMetaMutationResolver::class);
            $this->payloadableSetCommentMetaMutationResolver = $payloadableSetCommentMetaMutationResolver;
        }
        return $this->payloadableSetCommentMetaMutationResolver;
    }
    protected final function getPayloadableSetCommentMetaBulkOperationMutationResolver() : PayloadableSetCommentMetaBulkOperationMutationResolver
    {
        if ($this->payloadableSetCommentMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableSetCommentMetaBulkOperationMutationResolver */
            $payloadableSetCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetCommentMetaBulkOperationMutationResolver::class);
            $this->payloadableSetCommentMetaBulkOperationMutationResolver = $payloadableSetCommentMetaBulkOperationMutationResolver;
        }
        return $this->payloadableSetCommentMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateCommentMetaMutationResolver() : PayloadableUpdateCommentMetaMutationResolver
    {
        if ($this->payloadableUpdateCommentMetaMutationResolver === null) {
            /** @var PayloadableUpdateCommentMetaMutationResolver */
            $payloadableUpdateCommentMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCommentMetaMutationResolver::class);
            $this->payloadableUpdateCommentMetaMutationResolver = $payloadableUpdateCommentMetaMutationResolver;
        }
        return $this->payloadableUpdateCommentMetaMutationResolver;
    }
    protected final function getPayloadableUpdateCommentMetaBulkOperationMutationResolver() : PayloadableUpdateCommentMetaBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateCommentMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateCommentMetaBulkOperationMutationResolver */
            $payloadableUpdateCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCommentMetaBulkOperationMutationResolver::class);
            $this->payloadableUpdateCommentMetaBulkOperationMutationResolver = $payloadableUpdateCommentMetaBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateCommentMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddCommentMetaMutationResolver() : PayloadableAddCommentMetaMutationResolver
    {
        if ($this->payloadableAddCommentMetaMutationResolver === null) {
            /** @var PayloadableAddCommentMetaMutationResolver */
            $payloadableAddCommentMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddCommentMetaMutationResolver::class);
            $this->payloadableAddCommentMetaMutationResolver = $payloadableAddCommentMetaMutationResolver;
        }
        return $this->payloadableAddCommentMetaMutationResolver;
    }
    protected final function getPayloadableAddCommentMetaBulkOperationMutationResolver() : PayloadableAddCommentMetaBulkOperationMutationResolver
    {
        if ($this->payloadableAddCommentMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableAddCommentMetaBulkOperationMutationResolver */
            $payloadableAddCommentMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddCommentMetaBulkOperationMutationResolver::class);
            $this->payloadableAddCommentMetaBulkOperationMutationResolver = $payloadableAddCommentMetaBulkOperationMutationResolver;
        }
        return $this->payloadableAddCommentMetaBulkOperationMutationResolver;
    }
    protected final function getRootDeleteCommentMetaInputObjectTypeResolver() : RootDeleteCommentMetaInputObjectTypeResolver
    {
        if ($this->rootDeleteCommentMetaInputObjectTypeResolver === null) {
            /** @var RootDeleteCommentMetaInputObjectTypeResolver */
            $rootDeleteCommentMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteCommentMetaInputObjectTypeResolver::class);
            $this->rootDeleteCommentMetaInputObjectTypeResolver = $rootDeleteCommentMetaInputObjectTypeResolver;
        }
        return $this->rootDeleteCommentMetaInputObjectTypeResolver;
    }
    protected final function getRootSetCommentMetaInputObjectTypeResolver() : RootSetCommentMetaInputObjectTypeResolver
    {
        if ($this->rootSetCommentMetaInputObjectTypeResolver === null) {
            /** @var RootSetCommentMetaInputObjectTypeResolver */
            $rootSetCommentMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetCommentMetaInputObjectTypeResolver::class);
            $this->rootSetCommentMetaInputObjectTypeResolver = $rootSetCommentMetaInputObjectTypeResolver;
        }
        return $this->rootSetCommentMetaInputObjectTypeResolver;
    }
    protected final function getRootUpdateCommentMetaInputObjectTypeResolver() : RootUpdateCommentMetaInputObjectTypeResolver
    {
        if ($this->rootUpdateCommentMetaInputObjectTypeResolver === null) {
            /** @var RootUpdateCommentMetaInputObjectTypeResolver */
            $rootUpdateCommentMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateCommentMetaInputObjectTypeResolver::class);
            $this->rootUpdateCommentMetaInputObjectTypeResolver = $rootUpdateCommentMetaInputObjectTypeResolver;
        }
        return $this->rootUpdateCommentMetaInputObjectTypeResolver;
    }
    protected final function getRootAddCommentMetaInputObjectTypeResolver() : RootAddCommentMetaInputObjectTypeResolver
    {
        if ($this->rootAddCommentMetaInputObjectTypeResolver === null) {
            /** @var RootAddCommentMetaInputObjectTypeResolver */
            $rootAddCommentMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddCommentMetaInputObjectTypeResolver::class);
            $this->rootAddCommentMetaInputObjectTypeResolver = $rootAddCommentMetaInputObjectTypeResolver;
        }
        return $this->rootAddCommentMetaInputObjectTypeResolver;
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
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableCommentMetaMutations = $moduleConfiguration->addFieldsToQueryPayloadableCommentMetaMutations();
        return \array_merge(!$disableRedundantRootTypeMutationFields ? ['addCommentMeta', 'addCommentMetas', 'updateCommentMeta', 'updateCommentMetas', 'deleteCommentMeta', 'deleteCommentMetas', 'setCommentMeta', 'setCommentMetas'] : [], $addFieldsToQueryPayloadableCommentMetaMutations && !$disableRedundantRootTypeMutationFields ? ['addCommentMetaMutationPayloadObjects', 'updateCommentMetaMutationPayloadObjects', 'deleteCommentMetaMutationPayloadObjects', 'setCommentMetaMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addCommentMeta':
                return $this->__('Add meta to comment', 'comment-mutations');
            case 'addCommentMetas':
                return $this->__('Add meta to comments', 'comment-mutations');
            case 'updateCommentMeta':
                return $this->__('Update meta from comment', 'comment-mutations');
            case 'updateCommentMetas':
                return $this->__('Update meta from comments', 'comment-mutations');
            case 'deleteCommentMeta':
                return $this->__('Delete meta from comment', 'comment-mutations');
            case 'deleteCommentMetas':
                return $this->__('Delete meta from comments', 'comment-mutations');
            case 'setCommentMeta':
                return $this->__('Set meta on comment', 'comment-mutations');
            case 'setCommentMetas':
                return $this->__('Set meta on comments', 'comment-mutations');
            case 'addCommentMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addCommentMeta` mutation', 'comment-mutations');
            case 'updateCommentMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateCommentMeta` mutation', 'comment-mutations');
            case 'deleteCommentMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteCommentMeta` mutation', 'comment-mutations');
            case 'setCommentMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setCommentMeta` mutation', 'comment-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMetaMutations = $moduleConfiguration->usePayloadableCommentMetaMutations();
        if (!$usePayloadableCommentMetaMutations) {
            switch ($fieldName) {
                case 'addCommentMeta':
                case 'updateCommentMeta':
                case 'deleteCommentMeta':
                case 'setCommentMeta':
                    return SchemaTypeModifiers::NONE;
                case 'addCommentMetas':
                case 'updateCommentMetas':
                case 'deleteCommentMetas':
                case 'setCommentMetas':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['addCommentMetaMutationPayloadObjects', 'updateCommentMetaMutationPayloadObjects', 'deleteCommentMetaMutationPayloadObjects', 'setCommentMetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'addCommentMeta':
            case 'updateCommentMeta':
            case 'deleteCommentMeta':
            case 'setCommentMeta':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'addCommentMetas':
            case 'updateCommentMetas':
            case 'deleteCommentMetas':
            case 'setCommentMetas':
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
            case 'addCommentMeta':
                return ['input' => $this->getRootAddCommentMetaInputObjectTypeResolver()];
            case 'addCommentMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddCommentMetaInputObjectTypeResolver());
            case 'updateCommentMeta':
                return ['input' => $this->getRootUpdateCommentMetaInputObjectTypeResolver()];
            case 'updateCommentMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateCommentMetaInputObjectTypeResolver());
            case 'deleteCommentMeta':
                return ['input' => $this->getRootDeleteCommentMetaInputObjectTypeResolver()];
            case 'deleteCommentMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteCommentMetaInputObjectTypeResolver());
            case 'setCommentMeta':
                return ['input' => $this->getRootSetCommentMetaInputObjectTypeResolver()];
            case 'setCommentMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetCommentMetaInputObjectTypeResolver());
            case 'addCommentMetaMutationPayloadObjects':
            case 'updateCommentMetaMutationPayloadObjects':
            case 'deleteCommentMetaMutationPayloadObjects':
            case 'setCommentMetaMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['addCommentMetaMutationPayloadObjects', 'updateCommentMetaMutationPayloadObjects', 'deleteCommentMetaMutationPayloadObjects', 'setCommentMetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['addCommentMetas', 'updateCommentMetas', 'deleteCommentMetas', 'setCommentMetas'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['addCommentMeta' => 'input']:
            case ['updateCommentMeta' => 'input']:
            case ['deleteCommentMeta' => 'input']:
            case ['setCommentMeta' => 'input']:
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
        if (\in_array($fieldName, ['addCommentMetas', 'updateCommentMetas', 'deleteCommentMetas', 'setCommentMetas'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMetaMutations = $moduleConfiguration->usePayloadableCommentMetaMutations();
        switch ($fieldName) {
            case 'addCommentMeta':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableAddCommentMetaMutationResolver() : $this->getAddCommentMetaMutationResolver();
            case 'addCommentMetas':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableAddCommentMetaBulkOperationMutationResolver() : $this->getAddCommentMetaBulkOperationMutationResolver();
            case 'updateCommentMeta':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableUpdateCommentMetaMutationResolver() : $this->getUpdateCommentMetaMutationResolver();
            case 'updateCommentMetas':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableUpdateCommentMetaBulkOperationMutationResolver() : $this->getUpdateCommentMetaBulkOperationMutationResolver();
            case 'deleteCommentMeta':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableDeleteCommentMetaMutationResolver() : $this->getDeleteCommentMetaMutationResolver();
            case 'deleteCommentMetas':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableDeleteCommentMetaBulkOperationMutationResolver() : $this->getDeleteCommentMetaBulkOperationMutationResolver();
            case 'setCommentMeta':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableSetCommentMetaMutationResolver() : $this->getSetCommentMetaMutationResolver();
            case 'setCommentMetas':
                return $usePayloadableCommentMetaMutations ? $this->getPayloadableSetCommentMetaBulkOperationMutationResolver() : $this->getSetCommentMetaBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
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
        $usePayloadableCommentMetaMutations = $moduleConfiguration->usePayloadableCommentMetaMutations();
        if ($usePayloadableCommentMetaMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'addCommentMeta':
            case 'addCommentMetas':
            case 'updateCommentMeta':
            case 'updateCommentMetas':
            case 'deleteCommentMeta':
            case 'deleteCommentMetas':
            case 'setCommentMeta':
            case 'setCommentMetas':
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
            case 'addCommentMetaMutationPayloadObjects':
            case 'updateCommentMetaMutationPayloadObjects':
            case 'deleteCommentMetaMutationPayloadObjects':
            case 'setCommentMetaMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
