<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootAddCustomPostMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootDeleteCustomPostMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootSetCustomPostMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootUpdateCustomPostMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\Module;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver;
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
abstract class AbstractRootCustomPostCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver|null
     */
    private $addCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaBulkOperationMutationResolver|null
     */
    private $addCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver|null
     */
    private $deleteCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaBulkOperationMutationResolver|null
     */
    private $deleteCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver|null
     */
    private $setCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaBulkOperationMutationResolver|null
     */
    private $setCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver|null
     */
    private $updateCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaBulkOperationMutationResolver|null
     */
    private $updateCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver|null
     */
    private $payloadableDeleteCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaBulkOperationMutationResolver|null
     */
    private $payloadableDeleteCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver|null
     */
    private $payloadableSetCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaBulkOperationMutationResolver|null
     */
    private $payloadableSetCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver|null
     */
    private $payloadableUpdateCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaBulkOperationMutationResolver|null
     */
    private $payloadableUpdateCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver|null
     */
    private $payloadableAddCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaBulkOperationMutationResolver|null
     */
    private $payloadableAddCustomPostMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootDeleteCustomPostMetaInputObjectTypeResolver|null
     */
    private $rootDeleteCustomPostMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootSetCustomPostMetaInputObjectTypeResolver|null
     */
    private $rootSetCustomPostMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootUpdateCustomPostMetaInputObjectTypeResolver|null
     */
    private $rootUpdateCustomPostMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\RootAddCustomPostMetaInputObjectTypeResolver|null
     */
    private $rootAddCustomPostMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getAddCustomPostMetaMutationResolver() : AddCustomPostMetaMutationResolver
    {
        if ($this->addCustomPostMetaMutationResolver === null) {
            /** @var AddCustomPostMetaMutationResolver */
            $addCustomPostMetaMutationResolver = $this->instanceManager->getInstance(AddCustomPostMetaMutationResolver::class);
            $this->addCustomPostMetaMutationResolver = $addCustomPostMetaMutationResolver;
        }
        return $this->addCustomPostMetaMutationResolver;
    }
    protected final function getAddCustomPostMetaBulkOperationMutationResolver() : AddCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->addCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var AddCustomPostMetaBulkOperationMutationResolver */
            $addCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(AddCustomPostMetaBulkOperationMutationResolver::class);
            $this->addCustomPostMetaBulkOperationMutationResolver = $addCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->addCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getDeleteCustomPostMetaMutationResolver() : DeleteCustomPostMetaMutationResolver
    {
        if ($this->deleteCustomPostMetaMutationResolver === null) {
            /** @var DeleteCustomPostMetaMutationResolver */
            $deleteCustomPostMetaMutationResolver = $this->instanceManager->getInstance(DeleteCustomPostMetaMutationResolver::class);
            $this->deleteCustomPostMetaMutationResolver = $deleteCustomPostMetaMutationResolver;
        }
        return $this->deleteCustomPostMetaMutationResolver;
    }
    protected final function getDeleteCustomPostMetaBulkOperationMutationResolver() : DeleteCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->deleteCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var DeleteCustomPostMetaBulkOperationMutationResolver */
            $deleteCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteCustomPostMetaBulkOperationMutationResolver::class);
            $this->deleteCustomPostMetaBulkOperationMutationResolver = $deleteCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->deleteCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getSetCustomPostMetaMutationResolver() : SetCustomPostMetaMutationResolver
    {
        if ($this->setCustomPostMetaMutationResolver === null) {
            /** @var SetCustomPostMetaMutationResolver */
            $setCustomPostMetaMutationResolver = $this->instanceManager->getInstance(SetCustomPostMetaMutationResolver::class);
            $this->setCustomPostMetaMutationResolver = $setCustomPostMetaMutationResolver;
        }
        return $this->setCustomPostMetaMutationResolver;
    }
    protected final function getSetCustomPostMetaBulkOperationMutationResolver() : SetCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->setCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var SetCustomPostMetaBulkOperationMutationResolver */
            $setCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(SetCustomPostMetaBulkOperationMutationResolver::class);
            $this->setCustomPostMetaBulkOperationMutationResolver = $setCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->setCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getUpdateCustomPostMetaMutationResolver() : UpdateCustomPostMetaMutationResolver
    {
        if ($this->updateCustomPostMetaMutationResolver === null) {
            /** @var UpdateCustomPostMetaMutationResolver */
            $updateCustomPostMetaMutationResolver = $this->instanceManager->getInstance(UpdateCustomPostMetaMutationResolver::class);
            $this->updateCustomPostMetaMutationResolver = $updateCustomPostMetaMutationResolver;
        }
        return $this->updateCustomPostMetaMutationResolver;
    }
    protected final function getUpdateCustomPostMetaBulkOperationMutationResolver() : UpdateCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->updateCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var UpdateCustomPostMetaBulkOperationMutationResolver */
            $updateCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateCustomPostMetaBulkOperationMutationResolver::class);
            $this->updateCustomPostMetaBulkOperationMutationResolver = $updateCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->updateCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteCustomPostMetaMutationResolver() : PayloadableDeleteCustomPostMetaMutationResolver
    {
        if ($this->payloadableDeleteCustomPostMetaMutationResolver === null) {
            /** @var PayloadableDeleteCustomPostMetaMutationResolver */
            $payloadableDeleteCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCustomPostMetaMutationResolver::class);
            $this->payloadableDeleteCustomPostMetaMutationResolver = $payloadableDeleteCustomPostMetaMutationResolver;
        }
        return $this->payloadableDeleteCustomPostMetaMutationResolver;
    }
    protected final function getPayloadableDeleteCustomPostMetaBulkOperationMutationResolver() : PayloadableDeleteCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteCustomPostMetaBulkOperationMutationResolver */
            $payloadableDeleteCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCustomPostMetaBulkOperationMutationResolver::class);
            $this->payloadableDeleteCustomPostMetaBulkOperationMutationResolver = $payloadableDeleteCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetCustomPostMetaMutationResolver() : PayloadableSetCustomPostMetaMutationResolver
    {
        if ($this->payloadableSetCustomPostMetaMutationResolver === null) {
            /** @var PayloadableSetCustomPostMetaMutationResolver */
            $payloadableSetCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetCustomPostMetaMutationResolver::class);
            $this->payloadableSetCustomPostMetaMutationResolver = $payloadableSetCustomPostMetaMutationResolver;
        }
        return $this->payloadableSetCustomPostMetaMutationResolver;
    }
    protected final function getPayloadableSetCustomPostMetaBulkOperationMutationResolver() : PayloadableSetCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->payloadableSetCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableSetCustomPostMetaBulkOperationMutationResolver */
            $payloadableSetCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetCustomPostMetaBulkOperationMutationResolver::class);
            $this->payloadableSetCustomPostMetaBulkOperationMutationResolver = $payloadableSetCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->payloadableSetCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateCustomPostMetaMutationResolver() : PayloadableUpdateCustomPostMetaMutationResolver
    {
        if ($this->payloadableUpdateCustomPostMetaMutationResolver === null) {
            /** @var PayloadableUpdateCustomPostMetaMutationResolver */
            $payloadableUpdateCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCustomPostMetaMutationResolver::class);
            $this->payloadableUpdateCustomPostMetaMutationResolver = $payloadableUpdateCustomPostMetaMutationResolver;
        }
        return $this->payloadableUpdateCustomPostMetaMutationResolver;
    }
    protected final function getPayloadableUpdateCustomPostMetaBulkOperationMutationResolver() : PayloadableUpdateCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateCustomPostMetaBulkOperationMutationResolver */
            $payloadableUpdateCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCustomPostMetaBulkOperationMutationResolver::class);
            $this->payloadableUpdateCustomPostMetaBulkOperationMutationResolver = $payloadableUpdateCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddCustomPostMetaMutationResolver() : PayloadableAddCustomPostMetaMutationResolver
    {
        if ($this->payloadableAddCustomPostMetaMutationResolver === null) {
            /** @var PayloadableAddCustomPostMetaMutationResolver */
            $payloadableAddCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddCustomPostMetaMutationResolver::class);
            $this->payloadableAddCustomPostMetaMutationResolver = $payloadableAddCustomPostMetaMutationResolver;
        }
        return $this->payloadableAddCustomPostMetaMutationResolver;
    }
    protected final function getPayloadableAddCustomPostMetaBulkOperationMutationResolver() : PayloadableAddCustomPostMetaBulkOperationMutationResolver
    {
        if ($this->payloadableAddCustomPostMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableAddCustomPostMetaBulkOperationMutationResolver */
            $payloadableAddCustomPostMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddCustomPostMetaBulkOperationMutationResolver::class);
            $this->payloadableAddCustomPostMetaBulkOperationMutationResolver = $payloadableAddCustomPostMetaBulkOperationMutationResolver;
        }
        return $this->payloadableAddCustomPostMetaBulkOperationMutationResolver;
    }
    protected final function getRootDeleteCustomPostMetaInputObjectTypeResolver() : RootDeleteCustomPostMetaInputObjectTypeResolver
    {
        if ($this->rootDeleteCustomPostMetaInputObjectTypeResolver === null) {
            /** @var RootDeleteCustomPostMetaInputObjectTypeResolver */
            $rootDeleteCustomPostMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteCustomPostMetaInputObjectTypeResolver::class);
            $this->rootDeleteCustomPostMetaInputObjectTypeResolver = $rootDeleteCustomPostMetaInputObjectTypeResolver;
        }
        return $this->rootDeleteCustomPostMetaInputObjectTypeResolver;
    }
    protected final function getRootSetCustomPostMetaInputObjectTypeResolver() : RootSetCustomPostMetaInputObjectTypeResolver
    {
        if ($this->rootSetCustomPostMetaInputObjectTypeResolver === null) {
            /** @var RootSetCustomPostMetaInputObjectTypeResolver */
            $rootSetCustomPostMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetCustomPostMetaInputObjectTypeResolver::class);
            $this->rootSetCustomPostMetaInputObjectTypeResolver = $rootSetCustomPostMetaInputObjectTypeResolver;
        }
        return $this->rootSetCustomPostMetaInputObjectTypeResolver;
    }
    protected final function getRootUpdateCustomPostMetaInputObjectTypeResolver() : RootUpdateCustomPostMetaInputObjectTypeResolver
    {
        if ($this->rootUpdateCustomPostMetaInputObjectTypeResolver === null) {
            /** @var RootUpdateCustomPostMetaInputObjectTypeResolver */
            $rootUpdateCustomPostMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateCustomPostMetaInputObjectTypeResolver::class);
            $this->rootUpdateCustomPostMetaInputObjectTypeResolver = $rootUpdateCustomPostMetaInputObjectTypeResolver;
        }
        return $this->rootUpdateCustomPostMetaInputObjectTypeResolver;
    }
    protected final function getRootAddCustomPostMetaInputObjectTypeResolver() : RootAddCustomPostMetaInputObjectTypeResolver
    {
        if ($this->rootAddCustomPostMetaInputObjectTypeResolver === null) {
            /** @var RootAddCustomPostMetaInputObjectTypeResolver */
            $rootAddCustomPostMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddCustomPostMetaInputObjectTypeResolver::class);
            $this->rootAddCustomPostMetaInputObjectTypeResolver = $rootAddCustomPostMetaInputObjectTypeResolver;
        }
        return $this->rootAddCustomPostMetaInputObjectTypeResolver;
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
    protected abstract function getCustomPostEntityName() : string;
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        /** @var EngineModuleConfiguration */
        $engineModuleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        $disableRedundantRootTypeMutationFields = $engineModuleConfiguration->disableRedundantRootTypeMutationFields();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableCustomPostMetaMutations = $moduleConfiguration->addFieldsToQueryPayloadableCustomPostMetaMutations();
        return \array_merge(!$disableRedundantRootTypeMutationFields ? ['add' . $customPostEntityName . 'Meta', 'add' . $customPostEntityName . 'Metas', 'update' . $customPostEntityName . 'Meta', 'update' . $customPostEntityName . 'Metas', 'delete' . $customPostEntityName . 'Meta', 'delete' . $customPostEntityName . 'Metas', 'set' . $customPostEntityName . 'Meta', 'set' . $customPostEntityName . 'Metas'] : [], $addFieldsToQueryPayloadableCustomPostMetaMutations && !$disableRedundantRootTypeMutationFields ? ['add' . $customPostEntityName . 'MetaMutationPayloadObjects', 'update' . $customPostEntityName . 'MetaMutationPayloadObjects', 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects', 'set' . $customPostEntityName . 'MetaMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'Meta':
                return $this->__('Add meta to custom post', 'custompost-mutations');
            case 'add' . $customPostEntityName . 'Metas':
                return $this->__('Add meta to custom posts', 'custompost-mutations');
            case 'update' . $customPostEntityName . 'Meta':
                return $this->__('Update meta from custom post', 'custompost-mutations');
            case 'update' . $customPostEntityName . 'Metas':
                return $this->__('Update meta from custom posts', 'custompost-mutations');
            case 'delete' . $customPostEntityName . 'Meta':
                return $this->__('Delete meta from custom post', 'custompost-mutations');
            case 'delete' . $customPostEntityName . 'Metas':
                return $this->__('Delete meta from custom posts', 'custompost-mutations');
            case 'set' . $customPostEntityName . 'Meta':
                return $this->__('Set meta on custom post', 'custompost-mutations');
            case 'set' . $customPostEntityName . 'Metas':
                return $this->__('Set meta on custom posts', 'custompost-mutations');
            case 'add' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addCustomPostMeta` mutation', 'custompost-mutations');
            case 'update' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateCustomPostMeta` mutation', 'custompost-mutations');
            case 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteCustomPostMeta` mutation', 'custompost-mutations');
            case 'set' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setCustomPostMeta` mutation', 'custompost-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if (!$usePayloadableCustomPostMetaMutations) {
            switch ($fieldName) {
                case 'add' . $customPostEntityName . 'Meta':
                case 'update' . $customPostEntityName . 'Meta':
                case 'delete' . $customPostEntityName . 'Meta':
                case 'set' . $customPostEntityName . 'Meta':
                    return SchemaTypeModifiers::NONE;
                case 'add' . $customPostEntityName . 'Metas':
                case 'update' . $customPostEntityName . 'Metas':
                case 'delete' . $customPostEntityName . 'Metas':
                case 'set' . $customPostEntityName . 'Metas':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['add' . $customPostEntityName . 'MetaMutationPayloadObjects', 'update' . $customPostEntityName . 'MetaMutationPayloadObjects', 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects', 'set' . $customPostEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'Meta':
            case 'update' . $customPostEntityName . 'Meta':
            case 'delete' . $customPostEntityName . 'Meta':
            case 'set' . $customPostEntityName . 'Meta':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'add' . $customPostEntityName . 'Metas':
            case 'update' . $customPostEntityName . 'Metas':
            case 'delete' . $customPostEntityName . 'Metas':
            case 'set' . $customPostEntityName . 'Metas':
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
        $customPostEntityName = $this->getCustomPostEntityName();
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'Meta':
                return ['input' => $this->getRootAddCustomPostMetaInputObjectTypeResolver()];
            case 'add' . $customPostEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddCustomPostMetaInputObjectTypeResolver());
            case 'update' . $customPostEntityName . 'Meta':
                return ['input' => $this->getRootUpdateCustomPostMetaInputObjectTypeResolver()];
            case 'update' . $customPostEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateCustomPostMetaInputObjectTypeResolver());
            case 'delete' . $customPostEntityName . 'Meta':
                return ['input' => $this->getRootDeleteCustomPostMetaInputObjectTypeResolver()];
            case 'delete' . $customPostEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteCustomPostMetaInputObjectTypeResolver());
            case 'set' . $customPostEntityName . 'Meta':
                return ['input' => $this->getRootSetCustomPostMetaInputObjectTypeResolver()];
            case 'set' . $customPostEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetCustomPostMetaInputObjectTypeResolver());
            case 'add' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        if (\in_array($fieldName, ['add' . $customPostEntityName . 'MetaMutationPayloadObjects', 'update' . $customPostEntityName . 'MetaMutationPayloadObjects', 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects', 'set' . $customPostEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['add' . $customPostEntityName . 'Metas', 'update' . $customPostEntityName . 'Metas', 'delete' . $customPostEntityName . 'Metas', 'set' . $customPostEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['add' . $customPostEntityName . 'Meta' => 'input']:
            case ['update' . $customPostEntityName . 'Meta' => 'input']:
            case ['delete' . $customPostEntityName . 'Meta' => 'input']:
            case ['set' . $customPostEntityName . 'Meta' => 'input']:
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
        $customPostEntityName = $this->getCustomPostEntityName();
        if (\in_array($fieldName, ['add' . $customPostEntityName . 'Metas', 'update' . $customPostEntityName . 'Metas', 'delete' . $customPostEntityName . 'Metas', 'set' . $customPostEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        $customPostEntityName = $this->getCustomPostEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'Meta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableAddCustomPostMetaMutationResolver() : $this->getAddCustomPostMetaMutationResolver();
            case 'add' . $customPostEntityName . 'Metas':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableAddCustomPostMetaBulkOperationMutationResolver() : $this->getAddCustomPostMetaBulkOperationMutationResolver();
            case 'update' . $customPostEntityName . 'Meta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableUpdateCustomPostMetaMutationResolver() : $this->getUpdateCustomPostMetaMutationResolver();
            case 'update' . $customPostEntityName . 'Metas':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableUpdateCustomPostMetaBulkOperationMutationResolver() : $this->getUpdateCustomPostMetaBulkOperationMutationResolver();
            case 'delete' . $customPostEntityName . 'Meta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableDeleteCustomPostMetaMutationResolver() : $this->getDeleteCustomPostMetaMutationResolver();
            case 'delete' . $customPostEntityName . 'Metas':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableDeleteCustomPostMetaBulkOperationMutationResolver() : $this->getDeleteCustomPostMetaBulkOperationMutationResolver();
            case 'set' . $customPostEntityName . 'Meta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableSetCustomPostMetaMutationResolver() : $this->getSetCustomPostMetaMutationResolver();
            case 'set' . $customPostEntityName . 'Metas':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableSetCustomPostMetaBulkOperationMutationResolver() : $this->getSetCustomPostMetaBulkOperationMutationResolver();
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
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if ($usePayloadableCustomPostMetaMutations) {
            return $validationCheckpoints;
        }
        $customPostEntityName = $this->getCustomPostEntityName();
        switch ($fieldDataAccessor->getFieldName()) {
            case 'add' . $customPostEntityName . 'Meta':
            case 'add' . $customPostEntityName . 'Metas':
            case 'update' . $customPostEntityName . 'Meta':
            case 'update' . $customPostEntityName . 'Metas':
            case 'delete' . $customPostEntityName . 'Meta':
            case 'delete' . $customPostEntityName . 'Metas':
            case 'set' . $customPostEntityName . 'Meta':
            case 'set' . $customPostEntityName . 'Metas':
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
        $customPostEntityName = $this->getCustomPostEntityName();
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'add' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $customPostEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $customPostEntityName . 'MetaMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
