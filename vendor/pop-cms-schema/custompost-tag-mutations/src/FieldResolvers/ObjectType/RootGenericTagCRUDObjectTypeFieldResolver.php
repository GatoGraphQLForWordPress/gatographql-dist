<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\Module;
use PoPCMSSchema\TagMutations\ModuleConfiguration;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\DeleteGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootCreateGenericTagTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootDeleteGenericTagTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootUpdateGenericTagTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootCreateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootDeleteGenericTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
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
class RootGenericTagCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootDeleteGenericTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteGenericTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootCreateGenericTagTermMutationPayloadObjectTypeResolver|null
     */
    private $rootCreateGenericTagTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver|null
     */
    private $createGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermBulkOperationMutationResolver|null
     */
    private $createGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver|null
     */
    private $deleteGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\DeleteGenericTagTermBulkOperationMutationResolver|null
     */
    private $deleteGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver|null
     */
    private $updateGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermBulkOperationMutationResolver|null
     */
    private $updateGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver|null
     */
    private $payloadableDeleteGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermBulkOperationMutationResolver|null
     */
    private $payloadableDeleteGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver|null
     */
    private $payloadableUpdateGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermBulkOperationMutationResolver|null
     */
    private $payloadableUpdateGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver|null
     */
    private $payloadableCreateGenericTagTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermBulkOperationMutationResolver|null
     */
    private $payloadableCreateGenericTagTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootDeleteGenericTagTermInputObjectTypeResolver|null
     */
    private $rootDeleteGenericTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootUpdateGenericTagTermInputObjectTypeResolver|null
     */
    private $rootUpdateGenericTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\RootCreateGenericTagTermInputObjectTypeResolver|null
     */
    private $rootCreateGenericTagTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    protected final function getGenericTagObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    protected final function getRootDeleteGenericTagTermMutationPayloadObjectTypeResolver() : RootDeleteGenericTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteGenericTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteGenericTagTermMutationPayloadObjectTypeResolver */
            $rootDeleteGenericTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteGenericTagTermMutationPayloadObjectTypeResolver = $rootDeleteGenericTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteGenericTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateGenericTagTermMutationPayloadObjectTypeResolver() : RootUpdateGenericTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericTagTermMutationPayloadObjectTypeResolver */
            $rootUpdateGenericTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericTagTermMutationPayloadObjectTypeResolver = $rootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreateGenericTagTermMutationPayloadObjectTypeResolver() : RootCreateGenericTagTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreateGenericTagTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreateGenericTagTermMutationPayloadObjectTypeResolver */
            $rootCreateGenericTagTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericTagTermMutationPayloadObjectTypeResolver::class);
            $this->rootCreateGenericTagTermMutationPayloadObjectTypeResolver = $rootCreateGenericTagTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreateGenericTagTermMutationPayloadObjectTypeResolver;
    }
    protected final function getCreateGenericTagTermMutationResolver() : CreateGenericTagTermMutationResolver
    {
        if ($this->createGenericTagTermMutationResolver === null) {
            /** @var CreateGenericTagTermMutationResolver */
            $createGenericTagTermMutationResolver = $this->instanceManager->getInstance(CreateGenericTagTermMutationResolver::class);
            $this->createGenericTagTermMutationResolver = $createGenericTagTermMutationResolver;
        }
        return $this->createGenericTagTermMutationResolver;
    }
    protected final function getCreateGenericTagTermBulkOperationMutationResolver() : CreateGenericTagTermBulkOperationMutationResolver
    {
        if ($this->createGenericTagTermBulkOperationMutationResolver === null) {
            /** @var CreateGenericTagTermBulkOperationMutationResolver */
            $createGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(CreateGenericTagTermBulkOperationMutationResolver::class);
            $this->createGenericTagTermBulkOperationMutationResolver = $createGenericTagTermBulkOperationMutationResolver;
        }
        return $this->createGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getDeleteGenericTagTermMutationResolver() : DeleteGenericTagTermMutationResolver
    {
        if ($this->deleteGenericTagTermMutationResolver === null) {
            /** @var DeleteGenericTagTermMutationResolver */
            $deleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(DeleteGenericTagTermMutationResolver::class);
            $this->deleteGenericTagTermMutationResolver = $deleteGenericTagTermMutationResolver;
        }
        return $this->deleteGenericTagTermMutationResolver;
    }
    protected final function getDeleteGenericTagTermBulkOperationMutationResolver() : DeleteGenericTagTermBulkOperationMutationResolver
    {
        if ($this->deleteGenericTagTermBulkOperationMutationResolver === null) {
            /** @var DeleteGenericTagTermBulkOperationMutationResolver */
            $deleteGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteGenericTagTermBulkOperationMutationResolver::class);
            $this->deleteGenericTagTermBulkOperationMutationResolver = $deleteGenericTagTermBulkOperationMutationResolver;
        }
        return $this->deleteGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getUpdateGenericTagTermMutationResolver() : UpdateGenericTagTermMutationResolver
    {
        if ($this->updateGenericTagTermMutationResolver === null) {
            /** @var UpdateGenericTagTermMutationResolver */
            $updateGenericTagTermMutationResolver = $this->instanceManager->getInstance(UpdateGenericTagTermMutationResolver::class);
            $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
        }
        return $this->updateGenericTagTermMutationResolver;
    }
    protected final function getUpdateGenericTagTermBulkOperationMutationResolver() : UpdateGenericTagTermBulkOperationMutationResolver
    {
        if ($this->updateGenericTagTermBulkOperationMutationResolver === null) {
            /** @var UpdateGenericTagTermBulkOperationMutationResolver */
            $updateGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateGenericTagTermBulkOperationMutationResolver::class);
            $this->updateGenericTagTermBulkOperationMutationResolver = $updateGenericTagTermBulkOperationMutationResolver;
        }
        return $this->updateGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteGenericTagTermMutationResolver() : PayloadableDeleteGenericTagTermMutationResolver
    {
        if ($this->payloadableDeleteGenericTagTermMutationResolver === null) {
            /** @var PayloadableDeleteGenericTagTermMutationResolver */
            $payloadableDeleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericTagTermMutationResolver::class);
            $this->payloadableDeleteGenericTagTermMutationResolver = $payloadableDeleteGenericTagTermMutationResolver;
        }
        return $this->payloadableDeleteGenericTagTermMutationResolver;
    }
    protected final function getPayloadableDeleteGenericTagTermBulkOperationMutationResolver() : PayloadableDeleteGenericTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteGenericTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteGenericTagTermBulkOperationMutationResolver */
            $payloadableDeleteGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericTagTermBulkOperationMutationResolver::class);
            $this->payloadableDeleteGenericTagTermBulkOperationMutationResolver = $payloadableDeleteGenericTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateGenericTagTermMutationResolver() : PayloadableUpdateGenericTagTermMutationResolver
    {
        if ($this->payloadableUpdateGenericTagTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericTagTermMutationResolver */
            $payloadableUpdateGenericTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericTagTermMutationResolver::class);
            $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
        }
        return $this->payloadableUpdateGenericTagTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericTagTermBulkOperationMutationResolver() : PayloadableUpdateGenericTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateGenericTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateGenericTagTermBulkOperationMutationResolver */
            $payloadableUpdateGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericTagTermBulkOperationMutationResolver::class);
            $this->payloadableUpdateGenericTagTermBulkOperationMutationResolver = $payloadableUpdateGenericTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreateGenericTagTermMutationResolver() : PayloadableCreateGenericTagTermMutationResolver
    {
        if ($this->payloadableCreateGenericTagTermMutationResolver === null) {
            /** @var PayloadableCreateGenericTagTermMutationResolver */
            $payloadableCreateGenericTagTermMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericTagTermMutationResolver::class);
            $this->payloadableCreateGenericTagTermMutationResolver = $payloadableCreateGenericTagTermMutationResolver;
        }
        return $this->payloadableCreateGenericTagTermMutationResolver;
    }
    protected final function getPayloadableCreateGenericTagTermBulkOperationMutationResolver() : PayloadableCreateGenericTagTermBulkOperationMutationResolver
    {
        if ($this->payloadableCreateGenericTagTermBulkOperationMutationResolver === null) {
            /** @var PayloadableCreateGenericTagTermBulkOperationMutationResolver */
            $payloadableCreateGenericTagTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericTagTermBulkOperationMutationResolver::class);
            $this->payloadableCreateGenericTagTermBulkOperationMutationResolver = $payloadableCreateGenericTagTermBulkOperationMutationResolver;
        }
        return $this->payloadableCreateGenericTagTermBulkOperationMutationResolver;
    }
    protected final function getRootDeleteGenericTagTermInputObjectTypeResolver() : RootDeleteGenericTagTermInputObjectTypeResolver
    {
        if ($this->rootDeleteGenericTagTermInputObjectTypeResolver === null) {
            /** @var RootDeleteGenericTagTermInputObjectTypeResolver */
            $rootDeleteGenericTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericTagTermInputObjectTypeResolver::class);
            $this->rootDeleteGenericTagTermInputObjectTypeResolver = $rootDeleteGenericTagTermInputObjectTypeResolver;
        }
        return $this->rootDeleteGenericTagTermInputObjectTypeResolver;
    }
    protected final function getRootUpdateGenericTagTermInputObjectTypeResolver() : RootUpdateGenericTagTermInputObjectTypeResolver
    {
        if ($this->rootUpdateGenericTagTermInputObjectTypeResolver === null) {
            /** @var RootUpdateGenericTagTermInputObjectTypeResolver */
            $rootUpdateGenericTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericTagTermInputObjectTypeResolver::class);
            $this->rootUpdateGenericTagTermInputObjectTypeResolver = $rootUpdateGenericTagTermInputObjectTypeResolver;
        }
        return $this->rootUpdateGenericTagTermInputObjectTypeResolver;
    }
    protected final function getRootCreateGenericTagTermInputObjectTypeResolver() : RootCreateGenericTagTermInputObjectTypeResolver
    {
        if ($this->rootCreateGenericTagTermInputObjectTypeResolver === null) {
            /** @var RootCreateGenericTagTermInputObjectTypeResolver */
            $rootCreateGenericTagTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericTagTermInputObjectTypeResolver::class);
            $this->rootCreateGenericTagTermInputObjectTypeResolver = $rootCreateGenericTagTermInputObjectTypeResolver;
        }
        return $this->rootCreateGenericTagTermInputObjectTypeResolver;
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
        $addFieldsToQueryPayloadableTagMutations = $moduleConfiguration->addFieldsToQueryPayloadableTagMutations();
        return \array_merge(['createTag', 'createTags'], !$disableRedundantRootTypeMutationFields ? ['updateTag', 'updateTags', 'deleteTag', 'deleteTags'] : [], $addFieldsToQueryPayloadableTagMutations ? ['createTagMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableTagMutations && !$disableRedundantRootTypeMutationFields ? ['updateTagMutationPayloadObjects', 'deleteTagMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createTag':
                return $this->__('Create a tag', 'tag-mutations');
            case 'createTags':
                return $this->__('Create tags', 'tag-mutations');
            case 'updateTag':
                return $this->__('Update a tag', 'tag-mutations');
            case 'updateTags':
                return $this->__('Update tags', 'tag-mutations');
            case 'deleteTag':
                return $this->__('Delete a tag', 'tag-mutations');
            case 'deleteTags':
                return $this->__('Delete tags', 'tag-mutations');
            case 'createTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createTag` mutation', 'tag-mutations');
            case 'updateTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateTag` mutation', 'tag-mutations');
            case 'deleteTagMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteTag` mutation', 'tag-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if (!$usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'createTag':
                case 'updateTag':
                case 'deleteTag':
                    return SchemaTypeModifiers::NONE;
                case 'createTags':
                case 'updateTags':
                case 'deleteTags':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createTagMutationPayloadObjects', 'updateTagMutationPayloadObjects', 'deleteTagMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createTag':
            case 'updateTag':
            case 'deleteTag':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createTags':
            case 'updateTags':
            case 'deleteTags':
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
            case 'createTag':
                return ['input' => $this->getRootCreateGenericTagTermInputObjectTypeResolver()];
            case 'createTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreateGenericTagTermInputObjectTypeResolver());
            case 'updateTag':
                return ['input' => $this->getRootUpdateGenericTagTermInputObjectTypeResolver()];
            case 'updateTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateGenericTagTermInputObjectTypeResolver());
            case 'deleteTag':
                return ['input' => $this->getRootDeleteGenericTagTermInputObjectTypeResolver()];
            case 'deleteTags':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteGenericTagTermInputObjectTypeResolver());
            case 'createTagMutationPayloadObjects':
            case 'updateTagMutationPayloadObjects':
            case 'deleteTagMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createTagMutationPayloadObjects', 'updateTagMutationPayloadObjects', 'deleteTagMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createTags', 'updateTags', 'deleteTags'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createTag' => 'input']:
            case ['updateTag' => 'input']:
            case ['deleteTag' => 'input']:
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
        if (\in_array($fieldName, ['createTags', 'updateTags', 'deleteTags'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        switch ($fieldName) {
            case 'createTag':
                return $usePayloadableTagMutations ? $this->getPayloadableCreateGenericTagTermMutationResolver() : $this->getCreateGenericTagTermMutationResolver();
            case 'createTags':
                return $usePayloadableTagMutations ? $this->getPayloadableCreateGenericTagTermBulkOperationMutationResolver() : $this->getCreateGenericTagTermBulkOperationMutationResolver();
            case 'updateTag':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdateGenericTagTermMutationResolver() : $this->getUpdateGenericTagTermMutationResolver();
            case 'updateTags':
                return $usePayloadableTagMutations ? $this->getPayloadableUpdateGenericTagTermBulkOperationMutationResolver() : $this->getUpdateGenericTagTermBulkOperationMutationResolver();
            case 'deleteTag':
                return $usePayloadableTagMutations ? $this->getPayloadableDeleteGenericTagTermMutationResolver() : $this->getDeleteGenericTagTermMutationResolver();
            case 'deleteTags':
                return $usePayloadableTagMutations ? $this->getPayloadableDeleteGenericTagTermBulkOperationMutationResolver() : $this->getDeleteGenericTagTermBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if ($usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'createTag':
                case 'createTags':
                case 'createTagMutationPayloadObjects':
                    return $this->getRootCreateGenericTagTermMutationPayloadObjectTypeResolver();
                case 'updateTag':
                case 'updateTags':
                case 'updateTagMutationPayloadObjects':
                    return $this->getRootUpdateGenericTagTermMutationPayloadObjectTypeResolver();
                case 'deleteTag':
                case 'deleteTags':
                case 'deleteTagMutationPayloadObjects':
                    return $this->getRootDeleteGenericTagTermMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createTag':
            case 'createTags':
            case 'updateTag':
            case 'updateTags':
                return $this->getGenericTagObjectTypeResolver();
            case 'deleteTag':
            case 'deleteTags':
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
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if ($usePayloadableTagMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createTag':
            case 'createTags':
            case 'updateTag':
            case 'updateTags':
            case 'deleteTag':
            case 'deleteTags':
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
            case 'createTagMutationPayloadObjects':
            case 'updateTagMutationPayloadObjects':
            case 'deleteTagMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
