<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\Module;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootCreateGenericCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootUpdateGenericCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
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
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver|null
     */
    private $genericCustomPostObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootCreateGenericCustomPostMutationPayloadObjectTypeResolver|null
     */
    private $rootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver|null
     */
    private $createGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostBulkOperationMutationResolver|null
     */
    private $createGenericCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver|null
     */
    private $updateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostBulkOperationMutationResolver|null
     */
    private $updateGenericCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver|null
     */
    private $payloadableUpdateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableUpdateGenericCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver|null
     */
    private $payloadableCreateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostBulkOperationMutationResolver|null
     */
    private $payloadableCreateGenericCustomPostBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootUpdateGenericCustomPostInputObjectTypeResolver|null
     */
    private $rootUpdateGenericCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootCreateGenericCustomPostInputObjectTypeResolver|null
     */
    private $rootCreateGenericCustomPostInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    protected final function getRootUpdateGenericCustomPostMutationPayloadObjectTypeResolver() : RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver */
            $rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver = $rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreateGenericCustomPostMutationPayloadObjectTypeResolver() : RootCreateGenericCustomPostMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreateGenericCustomPostMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreateGenericCustomPostMutationPayloadObjectTypeResolver */
            $rootCreateGenericCustomPostMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCustomPostMutationPayloadObjectTypeResolver::class);
            $this->rootCreateGenericCustomPostMutationPayloadObjectTypeResolver = $rootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
    }
    protected final function getCreateGenericCustomPostMutationResolver() : CreateGenericCustomPostMutationResolver
    {
        if ($this->createGenericCustomPostMutationResolver === null) {
            /** @var CreateGenericCustomPostMutationResolver */
            $createGenericCustomPostMutationResolver = $this->instanceManager->getInstance(CreateGenericCustomPostMutationResolver::class);
            $this->createGenericCustomPostMutationResolver = $createGenericCustomPostMutationResolver;
        }
        return $this->createGenericCustomPostMutationResolver;
    }
    protected final function getCreateGenericCustomPostBulkOperationMutationResolver() : CreateGenericCustomPostBulkOperationMutationResolver
    {
        if ($this->createGenericCustomPostBulkOperationMutationResolver === null) {
            /** @var CreateGenericCustomPostBulkOperationMutationResolver */
            $createGenericCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(CreateGenericCustomPostBulkOperationMutationResolver::class);
            $this->createGenericCustomPostBulkOperationMutationResolver = $createGenericCustomPostBulkOperationMutationResolver;
        }
        return $this->createGenericCustomPostBulkOperationMutationResolver;
    }
    protected final function getUpdateGenericCustomPostMutationResolver() : UpdateGenericCustomPostMutationResolver
    {
        if ($this->updateGenericCustomPostMutationResolver === null) {
            /** @var UpdateGenericCustomPostMutationResolver */
            $updateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(UpdateGenericCustomPostMutationResolver::class);
            $this->updateGenericCustomPostMutationResolver = $updateGenericCustomPostMutationResolver;
        }
        return $this->updateGenericCustomPostMutationResolver;
    }
    protected final function getUpdateGenericCustomPostBulkOperationMutationResolver() : UpdateGenericCustomPostBulkOperationMutationResolver
    {
        if ($this->updateGenericCustomPostBulkOperationMutationResolver === null) {
            /** @var UpdateGenericCustomPostBulkOperationMutationResolver */
            $updateGenericCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateGenericCustomPostBulkOperationMutationResolver::class);
            $this->updateGenericCustomPostBulkOperationMutationResolver = $updateGenericCustomPostBulkOperationMutationResolver;
        }
        return $this->updateGenericCustomPostBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCustomPostMutationResolver() : PayloadableUpdateGenericCustomPostMutationResolver
    {
        if ($this->payloadableUpdateGenericCustomPostMutationResolver === null) {
            /** @var PayloadableUpdateGenericCustomPostMutationResolver */
            $payloadableUpdateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCustomPostMutationResolver::class);
            $this->payloadableUpdateGenericCustomPostMutationResolver = $payloadableUpdateGenericCustomPostMutationResolver;
        }
        return $this->payloadableUpdateGenericCustomPostMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCustomPostBulkOperationMutationResolver() : PayloadableUpdateGenericCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateGenericCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateGenericCustomPostBulkOperationMutationResolver */
            $payloadableUpdateGenericCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCustomPostBulkOperationMutationResolver::class);
            $this->payloadableUpdateGenericCustomPostBulkOperationMutationResolver = $payloadableUpdateGenericCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateGenericCustomPostBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreateGenericCustomPostMutationResolver() : PayloadableCreateGenericCustomPostMutationResolver
    {
        if ($this->payloadableCreateGenericCustomPostMutationResolver === null) {
            /** @var PayloadableCreateGenericCustomPostMutationResolver */
            $payloadableCreateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericCustomPostMutationResolver::class);
            $this->payloadableCreateGenericCustomPostMutationResolver = $payloadableCreateGenericCustomPostMutationResolver;
        }
        return $this->payloadableCreateGenericCustomPostMutationResolver;
    }
    protected final function getPayloadableCreateGenericCustomPostBulkOperationMutationResolver() : PayloadableCreateGenericCustomPostBulkOperationMutationResolver
    {
        if ($this->payloadableCreateGenericCustomPostBulkOperationMutationResolver === null) {
            /** @var PayloadableCreateGenericCustomPostBulkOperationMutationResolver */
            $payloadableCreateGenericCustomPostBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericCustomPostBulkOperationMutationResolver::class);
            $this->payloadableCreateGenericCustomPostBulkOperationMutationResolver = $payloadableCreateGenericCustomPostBulkOperationMutationResolver;
        }
        return $this->payloadableCreateGenericCustomPostBulkOperationMutationResolver;
    }
    protected final function getRootUpdateGenericCustomPostInputObjectTypeResolver() : RootUpdateGenericCustomPostInputObjectTypeResolver
    {
        if ($this->rootUpdateGenericCustomPostInputObjectTypeResolver === null) {
            /** @var RootUpdateGenericCustomPostInputObjectTypeResolver */
            $rootUpdateGenericCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCustomPostInputObjectTypeResolver::class);
            $this->rootUpdateGenericCustomPostInputObjectTypeResolver = $rootUpdateGenericCustomPostInputObjectTypeResolver;
        }
        return $this->rootUpdateGenericCustomPostInputObjectTypeResolver;
    }
    protected final function getRootCreateGenericCustomPostInputObjectTypeResolver() : RootCreateGenericCustomPostInputObjectTypeResolver
    {
        if ($this->rootCreateGenericCustomPostInputObjectTypeResolver === null) {
            /** @var RootCreateGenericCustomPostInputObjectTypeResolver */
            $rootCreateGenericCustomPostInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCustomPostInputObjectTypeResolver::class);
            $this->rootCreateGenericCustomPostInputObjectTypeResolver = $rootCreateGenericCustomPostInputObjectTypeResolver;
        }
        return $this->rootCreateGenericCustomPostInputObjectTypeResolver;
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
        $addFieldsToQueryPayloadableCustomPostMutations = $moduleConfiguration->addFieldsToQueryPayloadableCustomPostMutations();
        return \array_merge(['createCustomPost', 'createCustomPosts'], !$disableRedundantRootTypeMutationFields ? ['updateCustomPost', 'updateCustomPosts'] : [], $addFieldsToQueryPayloadableCustomPostMutations ? ['createCustomPostMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableCustomPostMutations && !$disableRedundantRootTypeMutationFields ? ['updateCustomPostMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createCustomPost':
                return $this->__('Create a custom post. This mutation accepts the data that is common to all custom posts (title, content, excerpt, slug, etc), but no custom data (such as the price of a Product CPT). So use it with care, only for those custom post types that do not require to be provided data for their own custom fields (for those, you will need to use a more specific mutation, for that CPT)', 'custompost-mutations');
            case 'createCustomPosts':
                return $this->__('Create custom posts. This mutation accepts the data that is common to all custom posts (title, content, excerpt, slug, etc), but no custom data (such as the price of a Product CPT). So use it with care, only for those custom post types that do not require to be provided data for their own custom fields (for those, you will need to use a more specific mutation, for that CPT)', 'custompost-mutations');
            case 'updateCustomPost':
                return $this->__('Update a custom post', 'custompost-mutations');
            case 'updateCustomPosts':
                return $this->__('Update custom posts', 'custompost-mutations');
            case 'createCustomPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createCustomPost` mutation', 'custompost-mutations');
            case 'updateCustomPostMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateCustomPost` mutation', 'custompost-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if (!$usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createCustomPost':
                case 'updateCustomPost':
                    return SchemaTypeModifiers::NONE;
                case 'createCustomPosts':
                case 'updateCustomPosts':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createCustomPostMutationPayloadObjects', 'updateCustomPostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createCustomPost':
            case 'updateCustomPost':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createCustomPosts':
            case 'updateCustomPosts':
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
            case 'createCustomPost':
                return ['input' => $this->getRootCreateGenericCustomPostInputObjectTypeResolver()];
            case 'createCustomPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreateGenericCustomPostInputObjectTypeResolver());
            case 'updateCustomPost':
                return ['input' => $this->getRootUpdateGenericCustomPostInputObjectTypeResolver()];
            case 'updateCustomPosts':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateGenericCustomPostInputObjectTypeResolver());
            case 'createCustomPostMutationPayloadObjects':
            case 'updateCustomPostMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createCustomPostMutationPayloadObjects', 'updateCustomPostMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createCustomPosts', 'updateCustomPosts'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createCustomPost' => 'input']:
            case ['updateCustomPost' => 'input']:
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
        if (\in_array($fieldName, ['createCustomPosts', 'updateCustomPosts'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'createCustomPost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreateGenericCustomPostMutationResolver() : $this->getCreateGenericCustomPostMutationResolver();
            case 'createCustomPosts':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreateGenericCustomPostBulkOperationMutationResolver() : $this->getCreateGenericCustomPostBulkOperationMutationResolver();
            case 'updateCustomPost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdateGenericCustomPostMutationResolver() : $this->getUpdateGenericCustomPostMutationResolver();
            case 'updateCustomPosts':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdateGenericCustomPostBulkOperationMutationResolver() : $this->getUpdateGenericCustomPostBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createCustomPost':
                case 'createCustomPosts':
                case 'createCustomPostMutationPayloadObjects':
                    return $this->getRootCreateGenericCustomPostMutationPayloadObjectTypeResolver();
                case 'updateCustomPost':
                case 'updateCustomPosts':
                case 'updateCustomPostMutationPayloadObjects':
                    return $this->getRootUpdateGenericCustomPostMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createCustomPost':
            case 'createCustomPosts':
            case 'updateCustomPost':
            case 'updateCustomPosts':
                return $this->getGenericCustomPostObjectTypeResolver();
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
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createCustomPost':
            case 'createCustomPosts':
            case 'updateCustomPost':
            case 'updateCustomPosts':
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
            case 'createCustomPostMutationPayloadObjects':
            case 'updateCustomPostMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
