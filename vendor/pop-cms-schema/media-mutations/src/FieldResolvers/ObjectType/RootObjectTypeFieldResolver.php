<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\Module;
use PoPCMSSchema\MediaMutations\ModuleConfiguration;
use PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemBulkOperationMutationResolver;
use PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\RootCreateMediaItemMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
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
        if ($engineModuleConfiguration->disableRedundantRootTypeMutationFields()) {
            return [];
        }
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableMediaMutations = $moduleConfiguration->addFieldsToQueryPayloadableMediaMutations();
        return \array_merge(['createMediaItem', 'createMediaItems'], $addFieldsToQueryPayloadableMediaMutations ? ['createMediaItemMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createMediaItem':
                return $this->__('Upload an attachment', 'media-mutations');
            case 'createMediaItems':
                return $this->__('Upload attachments', 'media-mutations');
            case 'createMediaItemMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createMediaItem` mutation', 'media-mutations');
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
                    return SchemaTypeModifiers::NONE;
                case 'createMediaItems':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createMediaItemMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createMediaItem':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createMediaItems':
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
            case 'createMediaItemMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createMediaItemMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createMediaItems'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createMediaItem' => 'input']:
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
        if (\in_array($fieldName, ['createMediaItems'])) {
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
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createMediaItem':
            case 'createMediaItems':
                return $this->getMediaObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'createMediaItemMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
