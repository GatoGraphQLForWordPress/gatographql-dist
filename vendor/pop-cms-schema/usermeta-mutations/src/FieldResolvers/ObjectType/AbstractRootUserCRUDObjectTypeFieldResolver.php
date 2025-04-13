<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootAddUserMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootDeleteUserMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootSetUserMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootUpdateUserMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\Module;
use PoPCMSSchema\UserMetaMutations\ModuleConfiguration;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaBulkOperationMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaMutationResolver;
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
abstract class AbstractRootUserCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver|null
     */
    private $addUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaBulkOperationMutationResolver|null
     */
    private $addUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver|null
     */
    private $deleteUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaBulkOperationMutationResolver|null
     */
    private $deleteUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver|null
     */
    private $setUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaBulkOperationMutationResolver|null
     */
    private $setUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaMutationResolver|null
     */
    private $updateUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaBulkOperationMutationResolver|null
     */
    private $updateUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver|null
     */
    private $payloadableDeleteUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaBulkOperationMutationResolver|null
     */
    private $payloadableDeleteUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver|null
     */
    private $payloadableSetUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaBulkOperationMutationResolver|null
     */
    private $payloadableSetUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver|null
     */
    private $payloadableUpdateUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaBulkOperationMutationResolver|null
     */
    private $payloadableUpdateUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver|null
     */
    private $payloadableAddUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaBulkOperationMutationResolver|null
     */
    private $payloadableAddUserMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootDeleteUserMetaInputObjectTypeResolver|null
     */
    private $rootDeleteUserMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootSetUserMetaInputObjectTypeResolver|null
     */
    private $rootSetUserMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootUpdateUserMetaInputObjectTypeResolver|null
     */
    private $rootUpdateUserMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\RootAddUserMetaInputObjectTypeResolver|null
     */
    private $rootAddUserMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getAddUserMetaMutationResolver() : AddUserMetaMutationResolver
    {
        if ($this->addUserMetaMutationResolver === null) {
            /** @var AddUserMetaMutationResolver */
            $addUserMetaMutationResolver = $this->instanceManager->getInstance(AddUserMetaMutationResolver::class);
            $this->addUserMetaMutationResolver = $addUserMetaMutationResolver;
        }
        return $this->addUserMetaMutationResolver;
    }
    protected final function getAddUserMetaBulkOperationMutationResolver() : AddUserMetaBulkOperationMutationResolver
    {
        if ($this->addUserMetaBulkOperationMutationResolver === null) {
            /** @var AddUserMetaBulkOperationMutationResolver */
            $addUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(AddUserMetaBulkOperationMutationResolver::class);
            $this->addUserMetaBulkOperationMutationResolver = $addUserMetaBulkOperationMutationResolver;
        }
        return $this->addUserMetaBulkOperationMutationResolver;
    }
    protected final function getDeleteUserMetaMutationResolver() : DeleteUserMetaMutationResolver
    {
        if ($this->deleteUserMetaMutationResolver === null) {
            /** @var DeleteUserMetaMutationResolver */
            $deleteUserMetaMutationResolver = $this->instanceManager->getInstance(DeleteUserMetaMutationResolver::class);
            $this->deleteUserMetaMutationResolver = $deleteUserMetaMutationResolver;
        }
        return $this->deleteUserMetaMutationResolver;
    }
    protected final function getDeleteUserMetaBulkOperationMutationResolver() : DeleteUserMetaBulkOperationMutationResolver
    {
        if ($this->deleteUserMetaBulkOperationMutationResolver === null) {
            /** @var DeleteUserMetaBulkOperationMutationResolver */
            $deleteUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteUserMetaBulkOperationMutationResolver::class);
            $this->deleteUserMetaBulkOperationMutationResolver = $deleteUserMetaBulkOperationMutationResolver;
        }
        return $this->deleteUserMetaBulkOperationMutationResolver;
    }
    protected final function getSetUserMetaMutationResolver() : SetUserMetaMutationResolver
    {
        if ($this->setUserMetaMutationResolver === null) {
            /** @var SetUserMetaMutationResolver */
            $setUserMetaMutationResolver = $this->instanceManager->getInstance(SetUserMetaMutationResolver::class);
            $this->setUserMetaMutationResolver = $setUserMetaMutationResolver;
        }
        return $this->setUserMetaMutationResolver;
    }
    protected final function getSetUserMetaBulkOperationMutationResolver() : SetUserMetaBulkOperationMutationResolver
    {
        if ($this->setUserMetaBulkOperationMutationResolver === null) {
            /** @var SetUserMetaBulkOperationMutationResolver */
            $setUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(SetUserMetaBulkOperationMutationResolver::class);
            $this->setUserMetaBulkOperationMutationResolver = $setUserMetaBulkOperationMutationResolver;
        }
        return $this->setUserMetaBulkOperationMutationResolver;
    }
    protected final function getUpdateUserMetaMutationResolver() : UpdateUserMetaMutationResolver
    {
        if ($this->updateUserMetaMutationResolver === null) {
            /** @var UpdateUserMetaMutationResolver */
            $updateUserMetaMutationResolver = $this->instanceManager->getInstance(UpdateUserMetaMutationResolver::class);
            $this->updateUserMetaMutationResolver = $updateUserMetaMutationResolver;
        }
        return $this->updateUserMetaMutationResolver;
    }
    protected final function getUpdateUserMetaBulkOperationMutationResolver() : UpdateUserMetaBulkOperationMutationResolver
    {
        if ($this->updateUserMetaBulkOperationMutationResolver === null) {
            /** @var UpdateUserMetaBulkOperationMutationResolver */
            $updateUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateUserMetaBulkOperationMutationResolver::class);
            $this->updateUserMetaBulkOperationMutationResolver = $updateUserMetaBulkOperationMutationResolver;
        }
        return $this->updateUserMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteUserMetaMutationResolver() : PayloadableDeleteUserMetaMutationResolver
    {
        if ($this->payloadableDeleteUserMetaMutationResolver === null) {
            /** @var PayloadableDeleteUserMetaMutationResolver */
            $payloadableDeleteUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteUserMetaMutationResolver::class);
            $this->payloadableDeleteUserMetaMutationResolver = $payloadableDeleteUserMetaMutationResolver;
        }
        return $this->payloadableDeleteUserMetaMutationResolver;
    }
    protected final function getPayloadableDeleteUserMetaBulkOperationMutationResolver() : PayloadableDeleteUserMetaBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteUserMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteUserMetaBulkOperationMutationResolver */
            $payloadableDeleteUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteUserMetaBulkOperationMutationResolver::class);
            $this->payloadableDeleteUserMetaBulkOperationMutationResolver = $payloadableDeleteUserMetaBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteUserMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetUserMetaMutationResolver() : PayloadableSetUserMetaMutationResolver
    {
        if ($this->payloadableSetUserMetaMutationResolver === null) {
            /** @var PayloadableSetUserMetaMutationResolver */
            $payloadableSetUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetUserMetaMutationResolver::class);
            $this->payloadableSetUserMetaMutationResolver = $payloadableSetUserMetaMutationResolver;
        }
        return $this->payloadableSetUserMetaMutationResolver;
    }
    protected final function getPayloadableSetUserMetaBulkOperationMutationResolver() : PayloadableSetUserMetaBulkOperationMutationResolver
    {
        if ($this->payloadableSetUserMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableSetUserMetaBulkOperationMutationResolver */
            $payloadableSetUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetUserMetaBulkOperationMutationResolver::class);
            $this->payloadableSetUserMetaBulkOperationMutationResolver = $payloadableSetUserMetaBulkOperationMutationResolver;
        }
        return $this->payloadableSetUserMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateUserMetaMutationResolver() : PayloadableUpdateUserMetaMutationResolver
    {
        if ($this->payloadableUpdateUserMetaMutationResolver === null) {
            /** @var PayloadableUpdateUserMetaMutationResolver */
            $payloadableUpdateUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateUserMetaMutationResolver::class);
            $this->payloadableUpdateUserMetaMutationResolver = $payloadableUpdateUserMetaMutationResolver;
        }
        return $this->payloadableUpdateUserMetaMutationResolver;
    }
    protected final function getPayloadableUpdateUserMetaBulkOperationMutationResolver() : PayloadableUpdateUserMetaBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateUserMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateUserMetaBulkOperationMutationResolver */
            $payloadableUpdateUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateUserMetaBulkOperationMutationResolver::class);
            $this->payloadableUpdateUserMetaBulkOperationMutationResolver = $payloadableUpdateUserMetaBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateUserMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddUserMetaMutationResolver() : PayloadableAddUserMetaMutationResolver
    {
        if ($this->payloadableAddUserMetaMutationResolver === null) {
            /** @var PayloadableAddUserMetaMutationResolver */
            $payloadableAddUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddUserMetaMutationResolver::class);
            $this->payloadableAddUserMetaMutationResolver = $payloadableAddUserMetaMutationResolver;
        }
        return $this->payloadableAddUserMetaMutationResolver;
    }
    protected final function getPayloadableAddUserMetaBulkOperationMutationResolver() : PayloadableAddUserMetaBulkOperationMutationResolver
    {
        if ($this->payloadableAddUserMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableAddUserMetaBulkOperationMutationResolver */
            $payloadableAddUserMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddUserMetaBulkOperationMutationResolver::class);
            $this->payloadableAddUserMetaBulkOperationMutationResolver = $payloadableAddUserMetaBulkOperationMutationResolver;
        }
        return $this->payloadableAddUserMetaBulkOperationMutationResolver;
    }
    protected final function getRootDeleteUserMetaInputObjectTypeResolver() : RootDeleteUserMetaInputObjectTypeResolver
    {
        if ($this->rootDeleteUserMetaInputObjectTypeResolver === null) {
            /** @var RootDeleteUserMetaInputObjectTypeResolver */
            $rootDeleteUserMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteUserMetaInputObjectTypeResolver::class);
            $this->rootDeleteUserMetaInputObjectTypeResolver = $rootDeleteUserMetaInputObjectTypeResolver;
        }
        return $this->rootDeleteUserMetaInputObjectTypeResolver;
    }
    protected final function getRootSetUserMetaInputObjectTypeResolver() : RootSetUserMetaInputObjectTypeResolver
    {
        if ($this->rootSetUserMetaInputObjectTypeResolver === null) {
            /** @var RootSetUserMetaInputObjectTypeResolver */
            $rootSetUserMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetUserMetaInputObjectTypeResolver::class);
            $this->rootSetUserMetaInputObjectTypeResolver = $rootSetUserMetaInputObjectTypeResolver;
        }
        return $this->rootSetUserMetaInputObjectTypeResolver;
    }
    protected final function getRootUpdateUserMetaInputObjectTypeResolver() : RootUpdateUserMetaInputObjectTypeResolver
    {
        if ($this->rootUpdateUserMetaInputObjectTypeResolver === null) {
            /** @var RootUpdateUserMetaInputObjectTypeResolver */
            $rootUpdateUserMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateUserMetaInputObjectTypeResolver::class);
            $this->rootUpdateUserMetaInputObjectTypeResolver = $rootUpdateUserMetaInputObjectTypeResolver;
        }
        return $this->rootUpdateUserMetaInputObjectTypeResolver;
    }
    protected final function getRootAddUserMetaInputObjectTypeResolver() : RootAddUserMetaInputObjectTypeResolver
    {
        if ($this->rootAddUserMetaInputObjectTypeResolver === null) {
            /** @var RootAddUserMetaInputObjectTypeResolver */
            $rootAddUserMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddUserMetaInputObjectTypeResolver::class);
            $this->rootAddUserMetaInputObjectTypeResolver = $rootAddUserMetaInputObjectTypeResolver;
        }
        return $this->rootAddUserMetaInputObjectTypeResolver;
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
        $addFieldsToQueryPayloadableUserMetaMutations = $moduleConfiguration->addFieldsToQueryPayloadableUserMetaMutations();
        return \array_merge(!$disableRedundantRootTypeMutationFields ? ['addUserMeta', 'addUserMetas', 'updateUserMeta', 'updateUserMetas', 'deleteUserMeta', 'deleteUserMetas', 'setUserMeta', 'setUserMetas'] : [], $addFieldsToQueryPayloadableUserMetaMutations && !$disableRedundantRootTypeMutationFields ? ['addUserMetaMutationPayloadObjects', 'updateUserMetaMutationPayloadObjects', 'deleteUserMetaMutationPayloadObjects', 'setUserMetaMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addUserMeta':
                return $this->__('Add meta to user', 'user-mutations');
            case 'addUserMetas':
                return $this->__('Add meta to users', 'user-mutations');
            case 'updateUserMeta':
                return $this->__('Update meta from user', 'user-mutations');
            case 'updateUserMetas':
                return $this->__('Update meta from users', 'user-mutations');
            case 'deleteUserMeta':
                return $this->__('Delete meta from user', 'user-mutations');
            case 'deleteUserMetas':
                return $this->__('Delete meta from users', 'user-mutations');
            case 'setUserMeta':
                return $this->__('Set meta on user', 'user-mutations');
            case 'setUserMetas':
                return $this->__('Set meta on users', 'user-mutations');
            case 'addUserMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addUserMeta` mutation', 'user-mutations');
            case 'updateUserMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateUserMeta` mutation', 'user-mutations');
            case 'deleteUserMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteUserMeta` mutation', 'user-mutations');
            case 'setUserMetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setUserMeta` mutation', 'user-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        if (!$usePayloadableUserMetaMutations) {
            switch ($fieldName) {
                case 'addUserMeta':
                case 'updateUserMeta':
                case 'deleteUserMeta':
                case 'setUserMeta':
                    return SchemaTypeModifiers::NONE;
                case 'addUserMetas':
                case 'updateUserMetas':
                case 'deleteUserMetas':
                case 'setUserMetas':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['addUserMetaMutationPayloadObjects', 'updateUserMetaMutationPayloadObjects', 'deleteUserMetaMutationPayloadObjects', 'setUserMetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'addUserMeta':
            case 'updateUserMeta':
            case 'deleteUserMeta':
            case 'setUserMeta':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'addUserMetas':
            case 'updateUserMetas':
            case 'deleteUserMetas':
            case 'setUserMetas':
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
            case 'addUserMeta':
                return ['input' => $this->getRootAddUserMetaInputObjectTypeResolver()];
            case 'addUserMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddUserMetaInputObjectTypeResolver());
            case 'updateUserMeta':
                return ['input' => $this->getRootUpdateUserMetaInputObjectTypeResolver()];
            case 'updateUserMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateUserMetaInputObjectTypeResolver());
            case 'deleteUserMeta':
                return ['input' => $this->getRootDeleteUserMetaInputObjectTypeResolver()];
            case 'deleteUserMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteUserMetaInputObjectTypeResolver());
            case 'setUserMeta':
                return ['input' => $this->getRootSetUserMetaInputObjectTypeResolver()];
            case 'setUserMetas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetUserMetaInputObjectTypeResolver());
            case 'addUserMetaMutationPayloadObjects':
            case 'updateUserMetaMutationPayloadObjects':
            case 'deleteUserMetaMutationPayloadObjects':
            case 'setUserMetaMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['addUserMetaMutationPayloadObjects', 'updateUserMetaMutationPayloadObjects', 'deleteUserMetaMutationPayloadObjects', 'setUserMetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['addUserMetas', 'updateUserMetas', 'deleteUserMetas', 'setUserMetas'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['addUserMeta' => 'input']:
            case ['updateUserMeta' => 'input']:
            case ['deleteUserMeta' => 'input']:
            case ['setUserMeta' => 'input']:
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
        if (\in_array($fieldName, ['addUserMetas', 'updateUserMetas', 'deleteUserMetas', 'setUserMetas'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        switch ($fieldName) {
            case 'addUserMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableAddUserMetaMutationResolver() : $this->getAddUserMetaMutationResolver();
            case 'addUserMetas':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableAddUserMetaBulkOperationMutationResolver() : $this->getAddUserMetaBulkOperationMutationResolver();
            case 'updateUserMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableUpdateUserMetaMutationResolver() : $this->getUpdateUserMetaMutationResolver();
            case 'updateUserMetas':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableUpdateUserMetaBulkOperationMutationResolver() : $this->getUpdateUserMetaBulkOperationMutationResolver();
            case 'deleteUserMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableDeleteUserMetaMutationResolver() : $this->getDeleteUserMetaMutationResolver();
            case 'deleteUserMetas':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableDeleteUserMetaBulkOperationMutationResolver() : $this->getDeleteUserMetaBulkOperationMutationResolver();
            case 'setUserMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableSetUserMetaMutationResolver() : $this->getSetUserMetaMutationResolver();
            case 'setUserMetas':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableSetUserMetaBulkOperationMutationResolver() : $this->getSetUserMetaBulkOperationMutationResolver();
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
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        if ($usePayloadableUserMetaMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'addUserMeta':
            case 'addUserMetas':
            case 'updateUserMeta':
            case 'updateUserMetas':
            case 'deleteUserMeta':
            case 'deleteUserMetas':
            case 'setUserMeta':
            case 'setUserMetas':
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
            case 'addUserMetaMutationPayloadObjects':
            case 'updateUserMetaMutationPayloadObjects':
            case 'deleteUserMetaMutationPayloadObjects':
            case 'setUserMetaMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
