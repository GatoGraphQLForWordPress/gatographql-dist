<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootAddTagTermMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootDeleteTagTermMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootSetTagTermMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootUpdateTagTermMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\Module;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver;
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
abstract class AbstractRootTagCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver|null
     */
    private $addTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaBulkOperationMutationResolver|null
     */
    private $addTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver|null
     */
    private $deleteTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaBulkOperationMutationResolver|null
     */
    private $deleteTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver|null
     */
    private $setTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaBulkOperationMutationResolver|null
     */
    private $setTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver|null
     */
    private $updateTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaBulkOperationMutationResolver|null
     */
    private $updateTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver|null
     */
    private $payloadableDeleteTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableDeleteTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver|null
     */
    private $payloadableSetTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableSetTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver|null
     */
    private $payloadableUpdateTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableUpdateTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver|null
     */
    private $payloadableAddTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableAddTagTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootDeleteTagTermMetaInputObjectTypeResolver|null
     */
    private $rootDeleteTagTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootSetTagTermMetaInputObjectTypeResolver|null
     */
    private $rootSetTagTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootUpdateTagTermMetaInputObjectTypeResolver|null
     */
    private $rootUpdateTagTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\RootAddTagTermMetaInputObjectTypeResolver|null
     */
    private $rootAddTagTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getAddTagTermMetaMutationResolver() : AddTagTermMetaMutationResolver
    {
        if ($this->addTagTermMetaMutationResolver === null) {
            /** @var AddTagTermMetaMutationResolver */
            $addTagTermMetaMutationResolver = $this->instanceManager->getInstance(AddTagTermMetaMutationResolver::class);
            $this->addTagTermMetaMutationResolver = $addTagTermMetaMutationResolver;
        }
        return $this->addTagTermMetaMutationResolver;
    }
    protected final function getAddTagTermMetaBulkOperationMutationResolver() : AddTagTermMetaBulkOperationMutationResolver
    {
        if ($this->addTagTermMetaBulkOperationMutationResolver === null) {
            /** @var AddTagTermMetaBulkOperationMutationResolver */
            $addTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(AddTagTermMetaBulkOperationMutationResolver::class);
            $this->addTagTermMetaBulkOperationMutationResolver = $addTagTermMetaBulkOperationMutationResolver;
        }
        return $this->addTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getDeleteTagTermMetaMutationResolver() : DeleteTagTermMetaMutationResolver
    {
        if ($this->deleteTagTermMetaMutationResolver === null) {
            /** @var DeleteTagTermMetaMutationResolver */
            $deleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(DeleteTagTermMetaMutationResolver::class);
            $this->deleteTagTermMetaMutationResolver = $deleteTagTermMetaMutationResolver;
        }
        return $this->deleteTagTermMetaMutationResolver;
    }
    protected final function getDeleteTagTermMetaBulkOperationMutationResolver() : DeleteTagTermMetaBulkOperationMutationResolver
    {
        if ($this->deleteTagTermMetaBulkOperationMutationResolver === null) {
            /** @var DeleteTagTermMetaBulkOperationMutationResolver */
            $deleteTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteTagTermMetaBulkOperationMutationResolver::class);
            $this->deleteTagTermMetaBulkOperationMutationResolver = $deleteTagTermMetaBulkOperationMutationResolver;
        }
        return $this->deleteTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getSetTagTermMetaMutationResolver() : SetTagTermMetaMutationResolver
    {
        if ($this->setTagTermMetaMutationResolver === null) {
            /** @var SetTagTermMetaMutationResolver */
            $setTagTermMetaMutationResolver = $this->instanceManager->getInstance(SetTagTermMetaMutationResolver::class);
            $this->setTagTermMetaMutationResolver = $setTagTermMetaMutationResolver;
        }
        return $this->setTagTermMetaMutationResolver;
    }
    protected final function getSetTagTermMetaBulkOperationMutationResolver() : SetTagTermMetaBulkOperationMutationResolver
    {
        if ($this->setTagTermMetaBulkOperationMutationResolver === null) {
            /** @var SetTagTermMetaBulkOperationMutationResolver */
            $setTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(SetTagTermMetaBulkOperationMutationResolver::class);
            $this->setTagTermMetaBulkOperationMutationResolver = $setTagTermMetaBulkOperationMutationResolver;
        }
        return $this->setTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getUpdateTagTermMetaMutationResolver() : UpdateTagTermMetaMutationResolver
    {
        if ($this->updateTagTermMetaMutationResolver === null) {
            /** @var UpdateTagTermMetaMutationResolver */
            $updateTagTermMetaMutationResolver = $this->instanceManager->getInstance(UpdateTagTermMetaMutationResolver::class);
            $this->updateTagTermMetaMutationResolver = $updateTagTermMetaMutationResolver;
        }
        return $this->updateTagTermMetaMutationResolver;
    }
    protected final function getUpdateTagTermMetaBulkOperationMutationResolver() : UpdateTagTermMetaBulkOperationMutationResolver
    {
        if ($this->updateTagTermMetaBulkOperationMutationResolver === null) {
            /** @var UpdateTagTermMetaBulkOperationMutationResolver */
            $updateTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateTagTermMetaBulkOperationMutationResolver::class);
            $this->updateTagTermMetaBulkOperationMutationResolver = $updateTagTermMetaBulkOperationMutationResolver;
        }
        return $this->updateTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteTagTermMetaMutationResolver() : PayloadableDeleteTagTermMetaMutationResolver
    {
        if ($this->payloadableDeleteTagTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteTagTermMetaMutationResolver */
            $payloadableDeleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteTagTermMetaMutationResolver::class);
            $this->payloadableDeleteTagTermMetaMutationResolver = $payloadableDeleteTagTermMetaMutationResolver;
        }
        return $this->payloadableDeleteTagTermMetaMutationResolver;
    }
    protected final function getPayloadableDeleteTagTermMetaBulkOperationMutationResolver() : PayloadableDeleteTagTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteTagTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteTagTermMetaBulkOperationMutationResolver */
            $payloadableDeleteTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteTagTermMetaBulkOperationMutationResolver::class);
            $this->payloadableDeleteTagTermMetaBulkOperationMutationResolver = $payloadableDeleteTagTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetTagTermMetaMutationResolver() : PayloadableSetTagTermMetaMutationResolver
    {
        if ($this->payloadableSetTagTermMetaMutationResolver === null) {
            /** @var PayloadableSetTagTermMetaMutationResolver */
            $payloadableSetTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagTermMetaMutationResolver::class);
            $this->payloadableSetTagTermMetaMutationResolver = $payloadableSetTagTermMetaMutationResolver;
        }
        return $this->payloadableSetTagTermMetaMutationResolver;
    }
    protected final function getPayloadableSetTagTermMetaBulkOperationMutationResolver() : PayloadableSetTagTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableSetTagTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableSetTagTermMetaBulkOperationMutationResolver */
            $payloadableSetTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagTermMetaBulkOperationMutationResolver::class);
            $this->payloadableSetTagTermMetaBulkOperationMutationResolver = $payloadableSetTagTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableSetTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateTagTermMetaMutationResolver() : PayloadableUpdateTagTermMetaMutationResolver
    {
        if ($this->payloadableUpdateTagTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateTagTermMetaMutationResolver */
            $payloadableUpdateTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateTagTermMetaMutationResolver::class);
            $this->payloadableUpdateTagTermMetaMutationResolver = $payloadableUpdateTagTermMetaMutationResolver;
        }
        return $this->payloadableUpdateTagTermMetaMutationResolver;
    }
    protected final function getPayloadableUpdateTagTermMetaBulkOperationMutationResolver() : PayloadableUpdateTagTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateTagTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateTagTermMetaBulkOperationMutationResolver */
            $payloadableUpdateTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateTagTermMetaBulkOperationMutationResolver::class);
            $this->payloadableUpdateTagTermMetaBulkOperationMutationResolver = $payloadableUpdateTagTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddTagTermMetaMutationResolver() : PayloadableAddTagTermMetaMutationResolver
    {
        if ($this->payloadableAddTagTermMetaMutationResolver === null) {
            /** @var PayloadableAddTagTermMetaMutationResolver */
            $payloadableAddTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddTagTermMetaMutationResolver::class);
            $this->payloadableAddTagTermMetaMutationResolver = $payloadableAddTagTermMetaMutationResolver;
        }
        return $this->payloadableAddTagTermMetaMutationResolver;
    }
    protected final function getPayloadableAddTagTermMetaBulkOperationMutationResolver() : PayloadableAddTagTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableAddTagTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableAddTagTermMetaBulkOperationMutationResolver */
            $payloadableAddTagTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddTagTermMetaBulkOperationMutationResolver::class);
            $this->payloadableAddTagTermMetaBulkOperationMutationResolver = $payloadableAddTagTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableAddTagTermMetaBulkOperationMutationResolver;
    }
    protected final function getRootDeleteTagTermMetaInputObjectTypeResolver() : RootDeleteTagTermMetaInputObjectTypeResolver
    {
        if ($this->rootDeleteTagTermMetaInputObjectTypeResolver === null) {
            /** @var RootDeleteTagTermMetaInputObjectTypeResolver */
            $rootDeleteTagTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteTagTermMetaInputObjectTypeResolver::class);
            $this->rootDeleteTagTermMetaInputObjectTypeResolver = $rootDeleteTagTermMetaInputObjectTypeResolver;
        }
        return $this->rootDeleteTagTermMetaInputObjectTypeResolver;
    }
    protected final function getRootSetTagTermMetaInputObjectTypeResolver() : RootSetTagTermMetaInputObjectTypeResolver
    {
        if ($this->rootSetTagTermMetaInputObjectTypeResolver === null) {
            /** @var RootSetTagTermMetaInputObjectTypeResolver */
            $rootSetTagTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetTagTermMetaInputObjectTypeResolver::class);
            $this->rootSetTagTermMetaInputObjectTypeResolver = $rootSetTagTermMetaInputObjectTypeResolver;
        }
        return $this->rootSetTagTermMetaInputObjectTypeResolver;
    }
    protected final function getRootUpdateTagTermMetaInputObjectTypeResolver() : RootUpdateTagTermMetaInputObjectTypeResolver
    {
        if ($this->rootUpdateTagTermMetaInputObjectTypeResolver === null) {
            /** @var RootUpdateTagTermMetaInputObjectTypeResolver */
            $rootUpdateTagTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateTagTermMetaInputObjectTypeResolver::class);
            $this->rootUpdateTagTermMetaInputObjectTypeResolver = $rootUpdateTagTermMetaInputObjectTypeResolver;
        }
        return $this->rootUpdateTagTermMetaInputObjectTypeResolver;
    }
    protected final function getRootAddTagTermMetaInputObjectTypeResolver() : RootAddTagTermMetaInputObjectTypeResolver
    {
        if ($this->rootAddTagTermMetaInputObjectTypeResolver === null) {
            /** @var RootAddTagTermMetaInputObjectTypeResolver */
            $rootAddTagTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddTagTermMetaInputObjectTypeResolver::class);
            $this->rootAddTagTermMetaInputObjectTypeResolver = $rootAddTagTermMetaInputObjectTypeResolver;
        }
        return $this->rootAddTagTermMetaInputObjectTypeResolver;
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
    protected abstract function getTagEntityName() : string;
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        $tagEntityName = $this->getTagEntityName();
        /** @var EngineModuleConfiguration */
        $engineModuleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        $disableRedundantRootTypeMutationFields = $engineModuleConfiguration->disableRedundantRootTypeMutationFields();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableTagMetaMutations = $moduleConfiguration->addFieldsToQueryPayloadableTagMetaMutations();
        return \array_merge(!$disableRedundantRootTypeMutationFields ? ['add' . $tagEntityName . 'Meta', 'add' . $tagEntityName . 'Metas', 'update' . $tagEntityName . 'Meta', 'update' . $tagEntityName . 'Metas', 'delete' . $tagEntityName . 'Meta', 'delete' . $tagEntityName . 'Metas', 'set' . $tagEntityName . 'Meta', 'set' . $tagEntityName . 'Metas'] : [], $addFieldsToQueryPayloadableTagMetaMutations && !$disableRedundantRootTypeMutationFields ? ['add' . $tagEntityName . 'MetaMutationPayloadObjects', 'update' . $tagEntityName . 'MetaMutationPayloadObjects', 'delete' . $tagEntityName . 'MetaMutationPayloadObjects', 'set' . $tagEntityName . 'MetaMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        $tagEntityName = $this->getTagEntityName();
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'Meta':
                return $this->__('Add meta to tag', 'tag-mutations');
            case 'add' . $tagEntityName . 'Metas':
                return $this->__('Add meta to tags', 'tag-mutations');
            case 'update' . $tagEntityName . 'Meta':
                return $this->__('Update meta from tag', 'tag-mutations');
            case 'update' . $tagEntityName . 'Metas':
                return $this->__('Update meta from tags', 'tag-mutations');
            case 'delete' . $tagEntityName . 'Meta':
                return $this->__('Delete meta from tag', 'tag-mutations');
            case 'delete' . $tagEntityName . 'Metas':
                return $this->__('Delete meta from tags', 'tag-mutations');
            case 'set' . $tagEntityName . 'Meta':
                return $this->__('Set meta on tag', 'tag-mutations');
            case 'set' . $tagEntityName . 'Metas':
                return $this->__('Set meta on tags', 'tag-mutations');
            case 'add' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addTagMeta` mutation', 'tag-mutations');
            case 'update' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateTagMeta` mutation', 'tag-mutations');
            case 'delete' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteTagMeta` mutation', 'tag-mutations');
            case 'set' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setTagMeta` mutation', 'tag-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        $tagEntityName = $this->getTagEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if (!$usePayloadableTagMetaMutations) {
            switch ($fieldName) {
                case 'add' . $tagEntityName . 'Meta':
                case 'update' . $tagEntityName . 'Meta':
                case 'delete' . $tagEntityName . 'Meta':
                case 'set' . $tagEntityName . 'Meta':
                    return SchemaTypeModifiers::NONE;
                case 'add' . $tagEntityName . 'Metas':
                case 'update' . $tagEntityName . 'Metas':
                case 'delete' . $tagEntityName . 'Metas':
                case 'set' . $tagEntityName . 'Metas':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['add' . $tagEntityName . 'MetaMutationPayloadObjects', 'update' . $tagEntityName . 'MetaMutationPayloadObjects', 'delete' . $tagEntityName . 'MetaMutationPayloadObjects', 'set' . $tagEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'Meta':
            case 'update' . $tagEntityName . 'Meta':
            case 'delete' . $tagEntityName . 'Meta':
            case 'set' . $tagEntityName . 'Meta':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'add' . $tagEntityName . 'Metas':
            case 'update' . $tagEntityName . 'Metas':
            case 'delete' . $tagEntityName . 'Metas':
            case 'set' . $tagEntityName . 'Metas':
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
        $tagEntityName = $this->getTagEntityName();
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'Meta':
                return ['input' => $this->getRootAddTagTermMetaInputObjectTypeResolver()];
            case 'add' . $tagEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddTagTermMetaInputObjectTypeResolver());
            case 'update' . $tagEntityName . 'Meta':
                return ['input' => $this->getRootUpdateTagTermMetaInputObjectTypeResolver()];
            case 'update' . $tagEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateTagTermMetaInputObjectTypeResolver());
            case 'delete' . $tagEntityName . 'Meta':
                return ['input' => $this->getRootDeleteTagTermMetaInputObjectTypeResolver()];
            case 'delete' . $tagEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteTagTermMetaInputObjectTypeResolver());
            case 'set' . $tagEntityName . 'Meta':
                return ['input' => $this->getRootSetTagTermMetaInputObjectTypeResolver()];
            case 'set' . $tagEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetTagTermMetaInputObjectTypeResolver());
            case 'add' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        $tagEntityName = $this->getTagEntityName();
        if (\in_array($fieldName, ['add' . $tagEntityName . 'MetaMutationPayloadObjects', 'update' . $tagEntityName . 'MetaMutationPayloadObjects', 'delete' . $tagEntityName . 'MetaMutationPayloadObjects', 'set' . $tagEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['add' . $tagEntityName . 'Metas', 'update' . $tagEntityName . 'Metas', 'delete' . $tagEntityName . 'Metas', 'set' . $tagEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['add' . $tagEntityName . 'Meta' => 'input']:
            case ['update' . $tagEntityName . 'Meta' => 'input']:
            case ['delete' . $tagEntityName . 'Meta' => 'input']:
            case ['set' . $tagEntityName . 'Meta' => 'input']:
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
        $tagEntityName = $this->getTagEntityName();
        if (\in_array($fieldName, ['add' . $tagEntityName . 'Metas', 'update' . $tagEntityName . 'Metas', 'delete' . $tagEntityName . 'Metas', 'set' . $tagEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        $tagEntityName = $this->getTagEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'Meta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableAddTagTermMetaMutationResolver() : $this->getAddTagTermMetaMutationResolver();
            case 'add' . $tagEntityName . 'Metas':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableAddTagTermMetaBulkOperationMutationResolver() : $this->getAddTagTermMetaBulkOperationMutationResolver();
            case 'update' . $tagEntityName . 'Meta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableUpdateTagTermMetaMutationResolver() : $this->getUpdateTagTermMetaMutationResolver();
            case 'update' . $tagEntityName . 'Metas':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableUpdateTagTermMetaBulkOperationMutationResolver() : $this->getUpdateTagTermMetaBulkOperationMutationResolver();
            case 'delete' . $tagEntityName . 'Meta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableDeleteTagTermMetaMutationResolver() : $this->getDeleteTagTermMetaMutationResolver();
            case 'delete' . $tagEntityName . 'Metas':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableDeleteTagTermMetaBulkOperationMutationResolver() : $this->getDeleteTagTermMetaBulkOperationMutationResolver();
            case 'set' . $tagEntityName . 'Meta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableSetTagTermMetaMutationResolver() : $this->getSetTagTermMetaMutationResolver();
            case 'set' . $tagEntityName . 'Metas':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableSetTagTermMetaBulkOperationMutationResolver() : $this->getSetTagTermMetaBulkOperationMutationResolver();
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
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if ($usePayloadableTagMetaMutations) {
            return $validationCheckpoints;
        }
        $tagEntityName = $this->getTagEntityName();
        switch ($fieldDataAccessor->getFieldName()) {
            case 'add' . $tagEntityName . 'Meta':
            case 'add' . $tagEntityName . 'Metas':
            case 'update' . $tagEntityName . 'Meta':
            case 'update' . $tagEntityName . 'Metas':
            case 'delete' . $tagEntityName . 'Meta':
            case 'delete' . $tagEntityName . 'Metas':
            case 'set' . $tagEntityName . 'Meta':
            case 'set' . $tagEntityName . 'Metas':
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
        $tagEntityName = $this->getTagEntityName();
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'add' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $tagEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $tagEntityName . 'MetaMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
