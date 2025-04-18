<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\Module;
use PoPCMSSchema\CustomPostMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostAddMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostDeleteMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostSetMetaInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostUpdateMetaInputObjectTypeResolver;
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
abstract class AbstractCustomPostObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostAddMetaInputObjectTypeResolver|null
     */
    private $customPostAddMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostDeleteMetaInputObjectTypeResolver|null
     */
    private $customPostDeleteMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostSetMetaInputObjectTypeResolver|null
     */
    private $customPostSetMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\InputObjectType\CustomPostUpdateMetaInputObjectTypeResolver|null
     */
    private $customPostUpdateMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver|null
     */
    private $addCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver|null
     */
    private $deleteCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver|null
     */
    private $setCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver|null
     */
    private $updateCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver|null
     */
    private $payloadableDeleteCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver|null
     */
    private $payloadableSetCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver|null
     */
    private $payloadableUpdateCustomPostMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver|null
     */
    private $payloadableAddCustomPostMetaMutationResolver;
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    protected final function getCustomPostAddMetaInputObjectTypeResolver() : CustomPostAddMetaInputObjectTypeResolver
    {
        if ($this->customPostAddMetaInputObjectTypeResolver === null) {
            /** @var CustomPostAddMetaInputObjectTypeResolver */
            $customPostAddMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostAddMetaInputObjectTypeResolver::class);
            $this->customPostAddMetaInputObjectTypeResolver = $customPostAddMetaInputObjectTypeResolver;
        }
        return $this->customPostAddMetaInputObjectTypeResolver;
    }
    protected final function getCustomPostDeleteMetaInputObjectTypeResolver() : CustomPostDeleteMetaInputObjectTypeResolver
    {
        if ($this->customPostDeleteMetaInputObjectTypeResolver === null) {
            /** @var CustomPostDeleteMetaInputObjectTypeResolver */
            $customPostDeleteMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostDeleteMetaInputObjectTypeResolver::class);
            $this->customPostDeleteMetaInputObjectTypeResolver = $customPostDeleteMetaInputObjectTypeResolver;
        }
        return $this->customPostDeleteMetaInputObjectTypeResolver;
    }
    protected final function getCustomPostSetMetaInputObjectTypeResolver() : CustomPostSetMetaInputObjectTypeResolver
    {
        if ($this->customPostSetMetaInputObjectTypeResolver === null) {
            /** @var CustomPostSetMetaInputObjectTypeResolver */
            $customPostSetMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostSetMetaInputObjectTypeResolver::class);
            $this->customPostSetMetaInputObjectTypeResolver = $customPostSetMetaInputObjectTypeResolver;
        }
        return $this->customPostSetMetaInputObjectTypeResolver;
    }
    protected final function getCustomPostUpdateMetaInputObjectTypeResolver() : CustomPostUpdateMetaInputObjectTypeResolver
    {
        if ($this->customPostUpdateMetaInputObjectTypeResolver === null) {
            /** @var CustomPostUpdateMetaInputObjectTypeResolver */
            $customPostUpdateMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostUpdateMetaInputObjectTypeResolver::class);
            $this->customPostUpdateMetaInputObjectTypeResolver = $customPostUpdateMetaInputObjectTypeResolver;
        }
        return $this->customPostUpdateMetaInputObjectTypeResolver;
    }
    protected final function getAddCustomPostMetaMutationResolver() : AddCustomPostMetaMutationResolver
    {
        if ($this->addCustomPostMetaMutationResolver === null) {
            /** @var AddCustomPostMetaMutationResolver */
            $addCustomPostMetaMutationResolver = $this->instanceManager->getInstance(AddCustomPostMetaMutationResolver::class);
            $this->addCustomPostMetaMutationResolver = $addCustomPostMetaMutationResolver;
        }
        return $this->addCustomPostMetaMutationResolver;
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
    protected final function getSetCustomPostMetaMutationResolver() : SetCustomPostMetaMutationResolver
    {
        if ($this->setCustomPostMetaMutationResolver === null) {
            /** @var SetCustomPostMetaMutationResolver */
            $setCustomPostMetaMutationResolver = $this->instanceManager->getInstance(SetCustomPostMetaMutationResolver::class);
            $this->setCustomPostMetaMutationResolver = $setCustomPostMetaMutationResolver;
        }
        return $this->setCustomPostMetaMutationResolver;
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
    protected final function getPayloadableDeleteCustomPostMetaMutationResolver() : PayloadableDeleteCustomPostMetaMutationResolver
    {
        if ($this->payloadableDeleteCustomPostMetaMutationResolver === null) {
            /** @var PayloadableDeleteCustomPostMetaMutationResolver */
            $payloadableDeleteCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCustomPostMetaMutationResolver::class);
            $this->payloadableDeleteCustomPostMetaMutationResolver = $payloadableDeleteCustomPostMetaMutationResolver;
        }
        return $this->payloadableDeleteCustomPostMetaMutationResolver;
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
    protected final function getPayloadableUpdateCustomPostMetaMutationResolver() : PayloadableUpdateCustomPostMetaMutationResolver
    {
        if ($this->payloadableUpdateCustomPostMetaMutationResolver === null) {
            /** @var PayloadableUpdateCustomPostMetaMutationResolver */
            $payloadableUpdateCustomPostMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCustomPostMetaMutationResolver::class);
            $this->payloadableUpdateCustomPostMetaMutationResolver = $payloadableUpdateCustomPostMetaMutationResolver;
        }
        return $this->payloadableUpdateCustomPostMetaMutationResolver;
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
                return $this->__('Add a custom post meta entry', 'custompostmeta-mutations');
            case 'deleteMeta':
                return $this->__('Delete a custom post meta entry', 'custompostmeta-mutations');
            case 'setMeta':
                return $this->__('Set meta entries to a a custom post', 'custompostmeta-mutations');
            case 'updateMeta':
                return $this->__('Update a custom post meta entry', 'custompostmeta-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        if (!$usePayloadableCustomPostMetaMutations) {
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
                return ['input' => $this->getCustomPostAddMetaInputObjectTypeResolver()];
            case 'deleteMeta':
                return ['input' => $this->getCustomPostDeleteMetaInputObjectTypeResolver()];
            case 'setMeta':
                return ['input' => $this->getCustomPostSetMetaInputObjectTypeResolver()];
            case 'updateMeta':
                return ['input' => $this->getCustomPostUpdateMetaInputObjectTypeResolver()];
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
        $customPost = $object;
        switch ($field->getName()) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::ID} = $objectTypeResolver->getID($customPost);
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMetaMutations = $moduleConfiguration->usePayloadableCustomPostMetaMutations();
        switch ($fieldName) {
            case 'addMeta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableAddCustomPostMetaMutationResolver() : $this->getAddCustomPostMetaMutationResolver();
            case 'updateMeta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableUpdateCustomPostMetaMutationResolver() : $this->getUpdateCustomPostMetaMutationResolver();
            case 'deleteMeta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableDeleteCustomPostMetaMutationResolver() : $this->getDeleteCustomPostMetaMutationResolver();
            case 'setMeta':
                return $usePayloadableCustomPostMetaMutations ? $this->getPayloadableSetCustomPostMetaMutationResolver() : $this->getSetCustomPostMetaMutationResolver();
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
