<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserMetaMutations\Module;
use PoPCMSSchema\UserMetaMutations\ModuleConfiguration;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaMutationResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserAddMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserDeleteMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserSetMetaInputObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserUpdateMetaInputObjectTypeResolver;
use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
abstract class AbstractUserObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserAddMetaInputObjectTypeResolver|null
     */
    private $userAddMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserDeleteMetaInputObjectTypeResolver|null
     */
    private $userDeleteMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserSetMetaInputObjectTypeResolver|null
     */
    private $userSetMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UserUpdateMetaInputObjectTypeResolver|null
     */
    private $userUpdateMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver|null
     */
    private $addUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver|null
     */
    private $deleteUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver|null
     */
    private $setUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\UpdateUserMetaMutationResolver|null
     */
    private $updateUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver|null
     */
    private $payloadableDeleteUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver|null
     */
    private $payloadableSetUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver|null
     */
    private $payloadableUpdateUserMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver|null
     */
    private $payloadableAddUserMetaMutationResolver;
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    protected final function getUserAddMetaInputObjectTypeResolver() : UserAddMetaInputObjectTypeResolver
    {
        if ($this->userAddMetaInputObjectTypeResolver === null) {
            /** @var UserAddMetaInputObjectTypeResolver */
            $userAddMetaInputObjectTypeResolver = $this->instanceManager->getInstance(UserAddMetaInputObjectTypeResolver::class);
            $this->userAddMetaInputObjectTypeResolver = $userAddMetaInputObjectTypeResolver;
        }
        return $this->userAddMetaInputObjectTypeResolver;
    }
    protected final function getUserDeleteMetaInputObjectTypeResolver() : UserDeleteMetaInputObjectTypeResolver
    {
        if ($this->userDeleteMetaInputObjectTypeResolver === null) {
            /** @var UserDeleteMetaInputObjectTypeResolver */
            $userDeleteMetaInputObjectTypeResolver = $this->instanceManager->getInstance(UserDeleteMetaInputObjectTypeResolver::class);
            $this->userDeleteMetaInputObjectTypeResolver = $userDeleteMetaInputObjectTypeResolver;
        }
        return $this->userDeleteMetaInputObjectTypeResolver;
    }
    protected final function getUserSetMetaInputObjectTypeResolver() : UserSetMetaInputObjectTypeResolver
    {
        if ($this->userSetMetaInputObjectTypeResolver === null) {
            /** @var UserSetMetaInputObjectTypeResolver */
            $userSetMetaInputObjectTypeResolver = $this->instanceManager->getInstance(UserSetMetaInputObjectTypeResolver::class);
            $this->userSetMetaInputObjectTypeResolver = $userSetMetaInputObjectTypeResolver;
        }
        return $this->userSetMetaInputObjectTypeResolver;
    }
    protected final function getUserUpdateMetaInputObjectTypeResolver() : UserUpdateMetaInputObjectTypeResolver
    {
        if ($this->userUpdateMetaInputObjectTypeResolver === null) {
            /** @var UserUpdateMetaInputObjectTypeResolver */
            $userUpdateMetaInputObjectTypeResolver = $this->instanceManager->getInstance(UserUpdateMetaInputObjectTypeResolver::class);
            $this->userUpdateMetaInputObjectTypeResolver = $userUpdateMetaInputObjectTypeResolver;
        }
        return $this->userUpdateMetaInputObjectTypeResolver;
    }
    protected final function getAddUserMetaMutationResolver() : AddUserMetaMutationResolver
    {
        if ($this->addUserMetaMutationResolver === null) {
            /** @var AddUserMetaMutationResolver */
            $addUserMetaMutationResolver = $this->instanceManager->getInstance(AddUserMetaMutationResolver::class);
            $this->addUserMetaMutationResolver = $addUserMetaMutationResolver;
        }
        return $this->addUserMetaMutationResolver;
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
    protected final function getSetUserMetaMutationResolver() : SetUserMetaMutationResolver
    {
        if ($this->setUserMetaMutationResolver === null) {
            /** @var SetUserMetaMutationResolver */
            $setUserMetaMutationResolver = $this->instanceManager->getInstance(SetUserMetaMutationResolver::class);
            $this->setUserMetaMutationResolver = $setUserMetaMutationResolver;
        }
        return $this->setUserMetaMutationResolver;
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
    protected final function getPayloadableDeleteUserMetaMutationResolver() : PayloadableDeleteUserMetaMutationResolver
    {
        if ($this->payloadableDeleteUserMetaMutationResolver === null) {
            /** @var PayloadableDeleteUserMetaMutationResolver */
            $payloadableDeleteUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteUserMetaMutationResolver::class);
            $this->payloadableDeleteUserMetaMutationResolver = $payloadableDeleteUserMetaMutationResolver;
        }
        return $this->payloadableDeleteUserMetaMutationResolver;
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
    protected final function getPayloadableUpdateUserMetaMutationResolver() : PayloadableUpdateUserMetaMutationResolver
    {
        if ($this->payloadableUpdateUserMetaMutationResolver === null) {
            /** @var PayloadableUpdateUserMetaMutationResolver */
            $payloadableUpdateUserMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateUserMetaMutationResolver::class);
            $this->payloadableUpdateUserMetaMutationResolver = $payloadableUpdateUserMetaMutationResolver;
        }
        return $this->payloadableUpdateUserMetaMutationResolver;
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
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['addMeta', 'deleteMeta', 'setMeta', 'updateMeta'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addMeta':
                return $this->__('Add a user meta entry', 'usermeta-mutations');
            case 'deleteMeta':
                return $this->__('Delete a user meta entry', 'usermeta-mutations');
            case 'setMeta':
                return $this->__('Set meta entries to a a user', 'usermeta-mutations');
            case 'updateMeta':
                return $this->__('Update a user meta entry', 'usermeta-mutations');
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
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return SchemaTypeModifiers::NONE;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                return SchemaTypeModifiers::NON_NULLABLE;
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
            case 'addMeta':
                return ['input' => $this->getUserAddMetaInputObjectTypeResolver()];
            case 'deleteMeta':
                return ['input' => $this->getUserDeleteMetaInputObjectTypeResolver()];
            case 'setMeta':
                return ['input' => $this->getUserSetMetaInputObjectTypeResolver()];
            case 'updateMeta':
                return ['input' => $this->getUserUpdateMetaInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['addMeta' => 'input']:
            case ['deleteMeta' => 'input']:
            case ['setMeta' => 'input']:
            case ['updateMeta' => 'input']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * Validated the mutation on the object because the ID
     * is obtained from the same object, so it's not originally
     * present in the field argument in the query
     */
    public function validateMutationOnObject(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : bool
    {
        switch ($fieldName) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                return \true;
        }
        return parent::validateMutationOnObject($objectTypeResolver, $fieldName);
    }
    /**
     * @param array<string,mixed> $fieldArgsForMutationForObject
     * @return array<string,mixed>
     */
    public function prepareFieldArgsForMutationForObject(array $fieldArgsForMutationForObject, ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field, object $object) : array
    {
        $fieldArgsForMutationForObject = parent::prepareFieldArgsForMutationForObject($fieldArgsForMutationForObject, $objectTypeResolver, $field, $object);
        $user = $object;
        switch ($field->getName()) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::ID} = $objectTypeResolver->getID($user);
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        switch ($fieldName) {
            case 'addMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableAddUserMetaMutationResolver() : $this->getAddUserMetaMutationResolver();
            case 'updateMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableUpdateUserMetaMutationResolver() : $this->getUpdateUserMetaMutationResolver();
            case 'deleteMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableDeleteUserMetaMutationResolver() : $this->getDeleteUserMetaMutationResolver();
            case 'setMeta':
                return $usePayloadableUserMetaMutations ? $this->getPayloadableSetUserMetaMutationResolver() : $this->getSetUserMetaMutationResolver();
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
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
}
