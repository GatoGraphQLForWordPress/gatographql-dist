<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\Module;
use PoPCMSSchema\MediaMutations\ModuleConfiguration;
use PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootUpdateMediaItemInputObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootCreateMediaItemMutationPayloadObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootUpdateMediaItemMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
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
     * @var \PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver|null
     */
    private $mediaObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver|null
     */
    private $createMediaItemMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemBulkOperationMutationResolver|null
     */
    private $createMediaItemBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver|null
     */
    private $updateMediaItemMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemBulkOperationMutationResolver|null
     */
    private $updateMediaItemBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver|null
     */
    private $rootCreateMediaItemInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootCreateMediaItemMutationPayloadObjectTypeResolver|null
     */
    private $rootCreateMediaItemMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver|null
     */
    private $payloadableCreateMediaItemMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemBulkOperationMutationResolver|null
     */
    private $payloadableCreateMediaItemBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootUpdateMediaItemInputObjectTypeResolver|null
     */
    private $rootUpdateMediaItemInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootUpdateMediaItemMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateMediaItemMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemMutationResolver|null
     */
    private $payloadableUpdateMediaItemMutationResolver;
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemBulkOperationMutationResolver|null
     */
    private $payloadableUpdateMediaItemBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    public final function setMediaObjectTypeResolver(MediaObjectTypeResolver $mediaObjectTypeResolver) : void
    {
        $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
    }
    protected final function getMediaObjectTypeResolver() : MediaObjectTypeResolver
    {
        if ($this->mediaObjectTypeResolver === null) {
            /** @var MediaObjectTypeResolver */
            $mediaObjectTypeResolver = $this->instanceManager->getInstance(MediaObjectTypeResolver::class);
            $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
        }
        return $this->mediaObjectTypeResolver;
    }
    public final function setCreateMediaItemMutationResolver(CreateMediaItemMutationResolver $createMediaItemMutationResolver) : void
    {
        $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
    }
    protected final function getCreateMediaItemMutationResolver() : CreateMediaItemMutationResolver
    {
        if ($this->createMediaItemMutationResolver === null) {
            /** @var CreateMediaItemMutationResolver */
            $createMediaItemMutationResolver = $this->instanceManager->getInstance(CreateMediaItemMutationResolver::class);
            $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
        }
        return $this->createMediaItemMutationResolver;
    }
    public final function setCreateMediaItemBulkOperationMutationResolver(CreateMediaItemBulkOperationMutationResolver $createMediaItemBulkOperationMutationResolver) : void
    {
        $this->createMediaItemBulkOperationMutationResolver = $createMediaItemBulkOperationMutationResolver;
    }
    protected final function getCreateMediaItemBulkOperationMutationResolver() : CreateMediaItemBulkOperationMutationResolver
    {
        if ($this->createMediaItemBulkOperationMutationResolver === null) {
            /** @var CreateMediaItemBulkOperationMutationResolver */
            $createMediaItemBulkOperationMutationResolver = $this->instanceManager->getInstance(CreateMediaItemBulkOperationMutationResolver::class);
            $this->createMediaItemBulkOperationMutationResolver = $createMediaItemBulkOperationMutationResolver;
        }
        return $this->createMediaItemBulkOperationMutationResolver;
    }
    public final function setUpdateMediaItemMutationResolver(UpdateMediaItemMutationResolver $updateMediaItemMutationResolver) : void
    {
        $this->updateMediaItemMutationResolver = $updateMediaItemMutationResolver;
    }
    protected final function getUpdateMediaItemMutationResolver() : UpdateMediaItemMutationResolver
    {
        if ($this->updateMediaItemMutationResolver === null) {
            /** @var UpdateMediaItemMutationResolver */
            $updateMediaItemMutationResolver = $this->instanceManager->getInstance(UpdateMediaItemMutationResolver::class);
            $this->updateMediaItemMutationResolver = $updateMediaItemMutationResolver;
        }
        return $this->updateMediaItemMutationResolver;
    }
    public final function setUpdateMediaItemBulkOperationMutationResolver(UpdateMediaItemBulkOperationMutationResolver $updateMediaItemBulkOperationMutationResolver) : void
    {
        $this->updateMediaItemBulkOperationMutationResolver = $updateMediaItemBulkOperationMutationResolver;
    }
    protected final function getUpdateMediaItemBulkOperationMutationResolver() : UpdateMediaItemBulkOperationMutationResolver
    {
        if ($this->updateMediaItemBulkOperationMutationResolver === null) {
            /** @var UpdateMediaItemBulkOperationMutationResolver */
            $updateMediaItemBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateMediaItemBulkOperationMutationResolver::class);
            $this->updateMediaItemBulkOperationMutationResolver = $updateMediaItemBulkOperationMutationResolver;
        }
        return $this->updateMediaItemBulkOperationMutationResolver;
    }
    public final function setRootCreateMediaItemInputObjectTypeResolver(RootCreateMediaItemInputObjectTypeResolver $rootCreateMediaItemInputObjectTypeResolver) : void
    {
        $this->rootCreateMediaItemInputObjectTypeResolver = $rootCreateMediaItemInputObjectTypeResolver;
    }
    protected final function getRootCreateMediaItemInputObjectTypeResolver() : RootCreateMediaItemInputObjectTypeResolver
    {
        if ($this->rootCreateMediaItemInputObjectTypeResolver === null) {
            /** @var RootCreateMediaItemInputObjectTypeResolver */
            $rootCreateMediaItemInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreateMediaItemInputObjectTypeResolver::class);
            $this->rootCreateMediaItemInputObjectTypeResolver = $rootCreateMediaItemInputObjectTypeResolver;
        }
        return $this->rootCreateMediaItemInputObjectTypeResolver;
    }
    public final function setRootCreateMediaItemMutationPayloadObjectTypeResolver(RootCreateMediaItemMutationPayloadObjectTypeResolver $rootCreateMediaItemMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreateMediaItemMutationPayloadObjectTypeResolver = $rootCreateMediaItemMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreateMediaItemMutationPayloadObjectTypeResolver() : RootCreateMediaItemMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreateMediaItemMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreateMediaItemMutationPayloadObjectTypeResolver */
            $rootCreateMediaItemMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreateMediaItemMutationPayloadObjectTypeResolver::class);
            $this->rootCreateMediaItemMutationPayloadObjectTypeResolver = $rootCreateMediaItemMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreateMediaItemMutationPayloadObjectTypeResolver;
    }
    public final function setPayloadableCreateMediaItemMutationResolver(PayloadableCreateMediaItemMutationResolver $payloadableCreateMediaItemMutationResolver) : void
    {
        $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
    }
    protected final function getPayloadableCreateMediaItemMutationResolver() : PayloadableCreateMediaItemMutationResolver
    {
        if ($this->payloadableCreateMediaItemMutationResolver === null) {
            /** @var PayloadableCreateMediaItemMutationResolver */
            $payloadableCreateMediaItemMutationResolver = $this->instanceManager->getInstance(PayloadableCreateMediaItemMutationResolver::class);
            $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
        }
        return $this->payloadableCreateMediaItemMutationResolver;
    }
    public final function setPayloadableCreateMediaItemBulkOperationMutationResolver(PayloadableCreateMediaItemBulkOperationMutationResolver $payloadableCreateMediaItemBulkOperationMutationResolver) : void
    {
        $this->payloadableCreateMediaItemBulkOperationMutationResolver = $payloadableCreateMediaItemBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreateMediaItemBulkOperationMutationResolver() : PayloadableCreateMediaItemBulkOperationMutationResolver
    {
        if ($this->payloadableCreateMediaItemBulkOperationMutationResolver === null) {
            /** @var PayloadableCreateMediaItemBulkOperationMutationResolver */
            $payloadableCreateMediaItemBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreateMediaItemBulkOperationMutationResolver::class);
            $this->payloadableCreateMediaItemBulkOperationMutationResolver = $payloadableCreateMediaItemBulkOperationMutationResolver;
        }
        return $this->payloadableCreateMediaItemBulkOperationMutationResolver;
    }
    public final function setRootUpdateMediaItemInputObjectTypeResolver(RootUpdateMediaItemInputObjectTypeResolver $rootUpdateMediaItemInputObjectTypeResolver) : void
    {
        $this->rootUpdateMediaItemInputObjectTypeResolver = $rootUpdateMediaItemInputObjectTypeResolver;
    }
    protected final function getRootUpdateMediaItemInputObjectTypeResolver() : RootUpdateMediaItemInputObjectTypeResolver
    {
        if ($this->rootUpdateMediaItemInputObjectTypeResolver === null) {
            /** @var RootUpdateMediaItemInputObjectTypeResolver */
            $rootUpdateMediaItemInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateMediaItemInputObjectTypeResolver::class);
            $this->rootUpdateMediaItemInputObjectTypeResolver = $rootUpdateMediaItemInputObjectTypeResolver;
        }
        return $this->rootUpdateMediaItemInputObjectTypeResolver;
    }
    public final function setRootUpdateMediaItemMutationPayloadObjectTypeResolver(RootUpdateMediaItemMutationPayloadObjectTypeResolver $rootUpdateMediaItemMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdateMediaItemMutationPayloadObjectTypeResolver = $rootUpdateMediaItemMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateMediaItemMutationPayloadObjectTypeResolver() : RootUpdateMediaItemMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateMediaItemMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateMediaItemMutationPayloadObjectTypeResolver */
            $rootUpdateMediaItemMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateMediaItemMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateMediaItemMutationPayloadObjectTypeResolver = $rootUpdateMediaItemMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateMediaItemMutationPayloadObjectTypeResolver;
    }
    public final function setPayloadableUpdateMediaItemMutationResolver(PayloadableUpdateMediaItemMutationResolver $payloadableUpdateMediaItemMutationResolver) : void
    {
        $this->payloadableUpdateMediaItemMutationResolver = $payloadableUpdateMediaItemMutationResolver;
    }
    protected final function getPayloadableUpdateMediaItemMutationResolver() : PayloadableUpdateMediaItemMutationResolver
    {
        if ($this->payloadableUpdateMediaItemMutationResolver === null) {
            /** @var PayloadableUpdateMediaItemMutationResolver */
            $payloadableUpdateMediaItemMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateMediaItemMutationResolver::class);
            $this->payloadableUpdateMediaItemMutationResolver = $payloadableUpdateMediaItemMutationResolver;
        }
        return $this->payloadableUpdateMediaItemMutationResolver;
    }
    public final function setPayloadableUpdateMediaItemBulkOperationMutationResolver(PayloadableUpdateMediaItemBulkOperationMutationResolver $payloadableUpdateMediaItemBulkOperationMutationResolver) : void
    {
        $this->payloadableUpdateMediaItemBulkOperationMutationResolver = $payloadableUpdateMediaItemBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateMediaItemBulkOperationMutationResolver() : PayloadableUpdateMediaItemBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateMediaItemBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateMediaItemBulkOperationMutationResolver */
            $payloadableUpdateMediaItemBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateMediaItemBulkOperationMutationResolver::class);
            $this->payloadableUpdateMediaItemBulkOperationMutationResolver = $payloadableUpdateMediaItemBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateMediaItemBulkOperationMutationResolver;
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
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableMediaMutations = $moduleConfiguration->addFieldsToQueryPayloadableMediaMutations();
        return \array_merge(['createMediaItem', 'createMediaItems'], !$disableRedundantRootTypeMutationFields ? ['updateMediaItem', 'updateMediaItems'] : [], $addFieldsToQueryPayloadableMediaMutations ? ['createMediaItemMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableMediaMutations && !$disableRedundantRootTypeMutationFields ? ['updateMediaItemMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createMediaItem':
                return $this->__('Upload an attachment', 'media-mutations');
            case 'createMediaItems':
                return $this->__('Upload attachments', 'media-mutations');
            case 'updateMediaItem':
                return $this->__('Update the metadata for an attachment', 'media-mutations');
            case 'updateMediaItems':
                return $this->__('Update the metadata for attachments', 'media-mutations');
            case 'createMediaItemMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createMediaItem` mutation', 'media-mutations');
            case 'updateMediaItemMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateMediaItem` mutation', 'media-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        if (!$usePayloadableMediaMutations) {
            switch ($fieldName) {
                case 'createMediaItem':
                case 'updateMediaItem':
                    return SchemaTypeModifiers::NONE;
                case 'createMediaItems':
                case 'updateMediaItems':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createMediaItemMutationPayloadObjects', 'updateMediaItemMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createMediaItem':
            case 'updateMediaItem':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createMediaItems':
            case 'updateMediaItems':
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
            case 'createMediaItem':
                return ['input' => $this->getRootCreateMediaItemInputObjectTypeResolver()];
            case 'createMediaItems':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreateMediaItemInputObjectTypeResolver());
            case 'updateMediaItem':
                return ['input' => $this->getRootUpdateMediaItemInputObjectTypeResolver()];
            case 'updateMediaItems':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateMediaItemInputObjectTypeResolver());
            case 'createMediaItemMutationPayloadObjects':
            case 'updateMediaItemMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createMediaItemMutationPayloadObjects', 'updateMediaItemMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createMediaItems', 'updateMediaItems'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createMediaItem' => 'input']:
            case ['updateMediaItem' => 'input']:
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
        if (\in_array($fieldName, ['createMediaItems', 'updateMediaItems'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        switch ($fieldName) {
            case 'createMediaItem':
                return $usePayloadableMediaMutations ? $this->getPayloadableCreateMediaItemMutationResolver() : $this->getCreateMediaItemMutationResolver();
            case 'createMediaItems':
                return $usePayloadableMediaMutations ? $this->getPayloadableCreateMediaItemBulkOperationMutationResolver() : $this->getCreateMediaItemBulkOperationMutationResolver();
            case 'updateMediaItem':
                return $usePayloadableMediaMutations ? $this->getPayloadableUpdateMediaItemMutationResolver() : $this->getUpdateMediaItemMutationResolver();
            case 'updateMediaItems':
                return $usePayloadableMediaMutations ? $this->getPayloadableUpdateMediaItemBulkOperationMutationResolver() : $this->getUpdateMediaItemBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        if ($usePayloadableMediaMutations) {
            switch ($fieldName) {
                case 'createMediaItem':
                case 'createMediaItems':
                case 'createMediaItemMutationPayloadObjects':
                    return $this->getRootCreateMediaItemMutationPayloadObjectTypeResolver();
                case 'updateMediaItem':
                case 'updateMediaItems':
                case 'updateMediaItemMutationPayloadObjects':
                    return $this->getRootUpdateMediaItemMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createMediaItem':
            case 'createMediaItems':
            case 'updateMediaItem':
            case 'updateMediaItems':
                return $this->getMediaObjectTypeResolver();
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
        $usePayloadableMediaMutations = $moduleConfiguration->usePayloadableMediaMutations();
        if ($usePayloadableMediaMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createMediaItem':
            case 'createMediaItems':
            case 'updateMediaItem':
            case 'updateMediaItems':
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
            case 'createMediaItemMutationPayloadObjects':
            case 'updateMediaItemMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
