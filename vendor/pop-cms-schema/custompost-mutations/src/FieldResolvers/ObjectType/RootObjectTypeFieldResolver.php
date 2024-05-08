<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\Module as CustomPostMutationsModule;
use PoPCMSSchema\CustomPostMutations\ModuleConfiguration as CustomPostMutationsModuleConfiguration;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootCreateGenericCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\RootUpdateGenericCustomPostInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
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
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver|null
     */
    private $updateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver|null
     */
    private $payloadableUpdateGenericCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver|null
     */
    private $payloadableCreateGenericCustomPostMutationResolver;
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
    public final function setGenericCustomPostObjectTypeResolver(GenericCustomPostObjectTypeResolver $genericCustomPostObjectTypeResolver) : void
    {
        $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
    }
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    public final function setRootUpdateGenericCustomPostMutationPayloadObjectTypeResolver(RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver $rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver = $rootUpdateGenericCustomPostMutationPayloadObjectTypeResolver;
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
    public final function setRootCreateGenericCustomPostMutationPayloadObjectTypeResolver(RootCreateGenericCustomPostMutationPayloadObjectTypeResolver $rootCreateGenericCustomPostMutationPayloadObjectTypeResolver) : void
    {
        $this->rootCreateGenericCustomPostMutationPayloadObjectTypeResolver = $rootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
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
    public final function setCreateGenericCustomPostMutationResolver(CreateGenericCustomPostMutationResolver $createGenericCustomPostMutationResolver) : void
    {
        $this->createGenericCustomPostMutationResolver = $createGenericCustomPostMutationResolver;
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
    public final function setUpdateGenericCustomPostMutationResolver(UpdateGenericCustomPostMutationResolver $updateGenericCustomPostMutationResolver) : void
    {
        $this->updateGenericCustomPostMutationResolver = $updateGenericCustomPostMutationResolver;
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
    public final function setPayloadableUpdateGenericCustomPostMutationResolver(PayloadableUpdateGenericCustomPostMutationResolver $payloadableUpdateGenericCustomPostMutationResolver) : void
    {
        $this->payloadableUpdateGenericCustomPostMutationResolver = $payloadableUpdateGenericCustomPostMutationResolver;
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
    public final function setPayloadableCreateGenericCustomPostMutationResolver(PayloadableCreateGenericCustomPostMutationResolver $payloadableCreateGenericCustomPostMutationResolver) : void
    {
        $this->payloadableCreateGenericCustomPostMutationResolver = $payloadableCreateGenericCustomPostMutationResolver;
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
    public final function setRootUpdateGenericCustomPostInputObjectTypeResolver(RootUpdateGenericCustomPostInputObjectTypeResolver $rootUpdateGenericCustomPostInputObjectTypeResolver) : void
    {
        $this->rootUpdateGenericCustomPostInputObjectTypeResolver = $rootUpdateGenericCustomPostInputObjectTypeResolver;
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
    public final function setRootCreateGenericCustomPostInputObjectTypeResolver(RootCreateGenericCustomPostInputObjectTypeResolver $rootCreateGenericCustomPostInputObjectTypeResolver) : void
    {
        $this->rootCreateGenericCustomPostInputObjectTypeResolver = $rootCreateGenericCustomPostInputObjectTypeResolver;
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
        $moduleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        return \array_merge(['createCustomPost'], !$moduleConfiguration->disableRedundantRootTypeMutationFields() ? ['updateCustomPost'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createCustomPost':
                return $this->__('Create a custom post. This mutation accepts the data that is common to all custom posts (title, content, excerpt, slug, etc), but no custom data (such as the price of a Product CPT). So use it with care, only for those custom post types that do not require to be provided data for their own custom fields (for those, you will need to use a more specific mutation, for that CPT)', 'custompost-mutations');
            case 'updateCustomPost':
                return $this->__('Update a custom post', 'custompost-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if (!$usePayloadableCustomPostMutations) {
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'createCustomPost':
            case 'updateCustomPost':
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
            case 'createCustomPost':
                return ['input' => $this->getRootCreateGenericCustomPostInputObjectTypeResolver()];
            case 'updateCustomPost':
                return ['input' => $this->getRootUpdateGenericCustomPostInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ($fieldArgName) {
            case 'input':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        switch ($fieldName) {
            case 'createCustomPost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableCreateGenericCustomPostMutationResolver() : $this->getCreateGenericCustomPostMutationResolver();
            case 'updateCustomPost':
                return $usePayloadableCustomPostMutations ? $this->getPayloadableUpdateGenericCustomPostMutationResolver() : $this->getUpdateGenericCustomPostMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CustomPostMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            switch ($fieldName) {
                case 'createCustomPost':
                    return $this->getRootCreateGenericCustomPostMutationPayloadObjectTypeResolver();
                case 'updateCustomPost':
                    return $this->getRootUpdateGenericCustomPostMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createCustomPost':
            case 'updateCustomPost':
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
         * @var CustomPostMutationsModuleConfiguration
         */
        $moduleConfiguration = App::getModule(CustomPostMutationsModule::class)->getConfiguration();
        $usePayloadableCustomPostMutations = $moduleConfiguration->usePayloadableCustomPostMutations();
        if ($usePayloadableCustomPostMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createCustomPost':
            case 'updateCustomPost':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
}
