<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootAddCategoryTermMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootDeleteCategoryTermMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootSetCategoryTermMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootUpdateCategoryTermMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\Module;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaBulkOperationMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver;
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
abstract class AbstractRootCategoryCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver|null
     */
    private $addCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $addCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver|null
     */
    private $deleteCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $deleteCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver|null
     */
    private $setCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $setCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver|null
     */
    private $updateCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $updateCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver|null
     */
    private $payloadableDeleteCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableDeleteCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver|null
     */
    private $payloadableSetCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableSetCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver|null
     */
    private $payloadableUpdateCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableUpdateCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver|null
     */
    private $payloadableAddCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaBulkOperationMutationResolver|null
     */
    private $payloadableAddCategoryTermMetaBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootDeleteCategoryTermMetaInputObjectTypeResolver|null
     */
    private $rootDeleteCategoryTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootSetCategoryTermMetaInputObjectTypeResolver|null
     */
    private $rootSetCategoryTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootUpdateCategoryTermMetaInputObjectTypeResolver|null
     */
    private $rootUpdateCategoryTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\RootAddCategoryTermMetaInputObjectTypeResolver|null
     */
    private $rootAddCategoryTermMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    protected final function getAddCategoryTermMetaMutationResolver() : AddCategoryTermMetaMutationResolver
    {
        if ($this->addCategoryTermMetaMutationResolver === null) {
            /** @var AddCategoryTermMetaMutationResolver */
            $addCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(AddCategoryTermMetaMutationResolver::class);
            $this->addCategoryTermMetaMutationResolver = $addCategoryTermMetaMutationResolver;
        }
        return $this->addCategoryTermMetaMutationResolver;
    }
    protected final function getAddCategoryTermMetaBulkOperationMutationResolver() : AddCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->addCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var AddCategoryTermMetaBulkOperationMutationResolver */
            $addCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(AddCategoryTermMetaBulkOperationMutationResolver::class);
            $this->addCategoryTermMetaBulkOperationMutationResolver = $addCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->addCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getDeleteCategoryTermMetaMutationResolver() : DeleteCategoryTermMetaMutationResolver
    {
        if ($this->deleteCategoryTermMetaMutationResolver === null) {
            /** @var DeleteCategoryTermMetaMutationResolver */
            $deleteCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(DeleteCategoryTermMetaMutationResolver::class);
            $this->deleteCategoryTermMetaMutationResolver = $deleteCategoryTermMetaMutationResolver;
        }
        return $this->deleteCategoryTermMetaMutationResolver;
    }
    protected final function getDeleteCategoryTermMetaBulkOperationMutationResolver() : DeleteCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->deleteCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var DeleteCategoryTermMetaBulkOperationMutationResolver */
            $deleteCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteCategoryTermMetaBulkOperationMutationResolver::class);
            $this->deleteCategoryTermMetaBulkOperationMutationResolver = $deleteCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->deleteCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getSetCategoryTermMetaMutationResolver() : SetCategoryTermMetaMutationResolver
    {
        if ($this->setCategoryTermMetaMutationResolver === null) {
            /** @var SetCategoryTermMetaMutationResolver */
            $setCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(SetCategoryTermMetaMutationResolver::class);
            $this->setCategoryTermMetaMutationResolver = $setCategoryTermMetaMutationResolver;
        }
        return $this->setCategoryTermMetaMutationResolver;
    }
    protected final function getSetCategoryTermMetaBulkOperationMutationResolver() : SetCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->setCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var SetCategoryTermMetaBulkOperationMutationResolver */
            $setCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(SetCategoryTermMetaBulkOperationMutationResolver::class);
            $this->setCategoryTermMetaBulkOperationMutationResolver = $setCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->setCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getUpdateCategoryTermMetaMutationResolver() : UpdateCategoryTermMetaMutationResolver
    {
        if ($this->updateCategoryTermMetaMutationResolver === null) {
            /** @var UpdateCategoryTermMetaMutationResolver */
            $updateCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(UpdateCategoryTermMetaMutationResolver::class);
            $this->updateCategoryTermMetaMutationResolver = $updateCategoryTermMetaMutationResolver;
        }
        return $this->updateCategoryTermMetaMutationResolver;
    }
    protected final function getUpdateCategoryTermMetaBulkOperationMutationResolver() : UpdateCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->updateCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var UpdateCategoryTermMetaBulkOperationMutationResolver */
            $updateCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateCategoryTermMetaBulkOperationMutationResolver::class);
            $this->updateCategoryTermMetaBulkOperationMutationResolver = $updateCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->updateCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteCategoryTermMetaMutationResolver() : PayloadableDeleteCategoryTermMetaMutationResolver
    {
        if ($this->payloadableDeleteCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteCategoryTermMetaMutationResolver */
            $payloadableDeleteCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCategoryTermMetaMutationResolver::class);
            $this->payloadableDeleteCategoryTermMetaMutationResolver = $payloadableDeleteCategoryTermMetaMutationResolver;
        }
        return $this->payloadableDeleteCategoryTermMetaMutationResolver;
    }
    protected final function getPayloadableDeleteCategoryTermMetaBulkOperationMutationResolver() : PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver */
            $payloadableDeleteCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver::class);
            $this->payloadableDeleteCategoryTermMetaBulkOperationMutationResolver = $payloadableDeleteCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableSetCategoryTermMetaMutationResolver() : PayloadableSetCategoryTermMetaMutationResolver
    {
        if ($this->payloadableSetCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableSetCategoryTermMetaMutationResolver */
            $payloadableSetCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetCategoryTermMetaMutationResolver::class);
            $this->payloadableSetCategoryTermMetaMutationResolver = $payloadableSetCategoryTermMetaMutationResolver;
        }
        return $this->payloadableSetCategoryTermMetaMutationResolver;
    }
    protected final function getPayloadableSetCategoryTermMetaBulkOperationMutationResolver() : PayloadableSetCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableSetCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableSetCategoryTermMetaBulkOperationMutationResolver */
            $payloadableSetCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableSetCategoryTermMetaBulkOperationMutationResolver::class);
            $this->payloadableSetCategoryTermMetaBulkOperationMutationResolver = $payloadableSetCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableSetCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateCategoryTermMetaMutationResolver() : PayloadableUpdateCategoryTermMetaMutationResolver
    {
        if ($this->payloadableUpdateCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateCategoryTermMetaMutationResolver */
            $payloadableUpdateCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCategoryTermMetaMutationResolver::class);
            $this->payloadableUpdateCategoryTermMetaMutationResolver = $payloadableUpdateCategoryTermMetaMutationResolver;
        }
        return $this->payloadableUpdateCategoryTermMetaMutationResolver;
    }
    protected final function getPayloadableUpdateCategoryTermMetaBulkOperationMutationResolver() : PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver */
            $payloadableUpdateCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver::class);
            $this->payloadableUpdateCategoryTermMetaBulkOperationMutationResolver = $payloadableUpdateCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getPayloadableAddCategoryTermMetaMutationResolver() : PayloadableAddCategoryTermMetaMutationResolver
    {
        if ($this->payloadableAddCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableAddCategoryTermMetaMutationResolver */
            $payloadableAddCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddCategoryTermMetaMutationResolver::class);
            $this->payloadableAddCategoryTermMetaMutationResolver = $payloadableAddCategoryTermMetaMutationResolver;
        }
        return $this->payloadableAddCategoryTermMetaMutationResolver;
    }
    protected final function getPayloadableAddCategoryTermMetaBulkOperationMutationResolver() : PayloadableAddCategoryTermMetaBulkOperationMutationResolver
    {
        if ($this->payloadableAddCategoryTermMetaBulkOperationMutationResolver === null) {
            /** @var PayloadableAddCategoryTermMetaBulkOperationMutationResolver */
            $payloadableAddCategoryTermMetaBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableAddCategoryTermMetaBulkOperationMutationResolver::class);
            $this->payloadableAddCategoryTermMetaBulkOperationMutationResolver = $payloadableAddCategoryTermMetaBulkOperationMutationResolver;
        }
        return $this->payloadableAddCategoryTermMetaBulkOperationMutationResolver;
    }
    protected final function getRootDeleteCategoryTermMetaInputObjectTypeResolver() : RootDeleteCategoryTermMetaInputObjectTypeResolver
    {
        if ($this->rootDeleteCategoryTermMetaInputObjectTypeResolver === null) {
            /** @var RootDeleteCategoryTermMetaInputObjectTypeResolver */
            $rootDeleteCategoryTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteCategoryTermMetaInputObjectTypeResolver::class);
            $this->rootDeleteCategoryTermMetaInputObjectTypeResolver = $rootDeleteCategoryTermMetaInputObjectTypeResolver;
        }
        return $this->rootDeleteCategoryTermMetaInputObjectTypeResolver;
    }
    protected final function getRootSetCategoryTermMetaInputObjectTypeResolver() : RootSetCategoryTermMetaInputObjectTypeResolver
    {
        if ($this->rootSetCategoryTermMetaInputObjectTypeResolver === null) {
            /** @var RootSetCategoryTermMetaInputObjectTypeResolver */
            $rootSetCategoryTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootSetCategoryTermMetaInputObjectTypeResolver::class);
            $this->rootSetCategoryTermMetaInputObjectTypeResolver = $rootSetCategoryTermMetaInputObjectTypeResolver;
        }
        return $this->rootSetCategoryTermMetaInputObjectTypeResolver;
    }
    protected final function getRootUpdateCategoryTermMetaInputObjectTypeResolver() : RootUpdateCategoryTermMetaInputObjectTypeResolver
    {
        if ($this->rootUpdateCategoryTermMetaInputObjectTypeResolver === null) {
            /** @var RootUpdateCategoryTermMetaInputObjectTypeResolver */
            $rootUpdateCategoryTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateCategoryTermMetaInputObjectTypeResolver::class);
            $this->rootUpdateCategoryTermMetaInputObjectTypeResolver = $rootUpdateCategoryTermMetaInputObjectTypeResolver;
        }
        return $this->rootUpdateCategoryTermMetaInputObjectTypeResolver;
    }
    protected final function getRootAddCategoryTermMetaInputObjectTypeResolver() : RootAddCategoryTermMetaInputObjectTypeResolver
    {
        if ($this->rootAddCategoryTermMetaInputObjectTypeResolver === null) {
            /** @var RootAddCategoryTermMetaInputObjectTypeResolver */
            $rootAddCategoryTermMetaInputObjectTypeResolver = $this->instanceManager->getInstance(RootAddCategoryTermMetaInputObjectTypeResolver::class);
            $this->rootAddCategoryTermMetaInputObjectTypeResolver = $rootAddCategoryTermMetaInputObjectTypeResolver;
        }
        return $this->rootAddCategoryTermMetaInputObjectTypeResolver;
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
    protected abstract function getCategoryEntityName() : string;
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        $categoryEntityName = $this->getCategoryEntityName();
        /** @var EngineModuleConfiguration */
        $engineModuleConfiguration = App::getModule(EngineModule::class)->getConfiguration();
        $disableRedundantRootTypeMutationFields = $engineModuleConfiguration->disableRedundantRootTypeMutationFields();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableCategoryMetaMutations = $moduleConfiguration->addFieldsToQueryPayloadableCategoryMetaMutations();
        return \array_merge(!$disableRedundantRootTypeMutationFields ? ['add' . $categoryEntityName . 'Meta', 'add' . $categoryEntityName . 'Metas', 'update' . $categoryEntityName . 'Meta', 'update' . $categoryEntityName . 'Metas', 'delete' . $categoryEntityName . 'Meta', 'delete' . $categoryEntityName . 'Metas', 'set' . $categoryEntityName . 'Meta', 'set' . $categoryEntityName . 'Metas'] : [], $addFieldsToQueryPayloadableCategoryMetaMutations && !$disableRedundantRootTypeMutationFields ? ['add' . $categoryEntityName . 'MetaMutationPayloadObjects', 'update' . $categoryEntityName . 'MetaMutationPayloadObjects', 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects', 'set' . $categoryEntityName . 'MetaMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        $categoryEntityName = $this->getCategoryEntityName();
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'Meta':
                return $this->__('Add meta to category', 'category-mutations');
            case 'add' . $categoryEntityName . 'Metas':
                return $this->__('Add meta to categories', 'category-mutations');
            case 'update' . $categoryEntityName . 'Meta':
                return $this->__('Update meta from category', 'category-mutations');
            case 'update' . $categoryEntityName . 'Metas':
                return $this->__('Update meta from categories', 'category-mutations');
            case 'delete' . $categoryEntityName . 'Meta':
                return $this->__('Delete meta from category', 'category-mutations');
            case 'delete' . $categoryEntityName . 'Metas':
                return $this->__('Delete meta from categories', 'category-mutations');
            case 'set' . $categoryEntityName . 'Meta':
                return $this->__('Set meta on category', 'category-mutations');
            case 'set' . $categoryEntityName . 'Metas':
                return $this->__('Set meta on categories', 'category-mutations');
            case 'add' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `addCategoryMeta` mutation', 'category-mutations');
            case 'update' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateCategoryMeta` mutation', 'category-mutations');
            case 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteCategoryMeta` mutation', 'category-mutations');
            case 'set' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `setCategoryMeta` mutation', 'category-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        $categoryEntityName = $this->getCategoryEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        if (!$usePayloadableCategoryMetaMutations) {
            switch ($fieldName) {
                case 'add' . $categoryEntityName . 'Meta':
                case 'update' . $categoryEntityName . 'Meta':
                case 'delete' . $categoryEntityName . 'Meta':
                case 'set' . $categoryEntityName . 'Meta':
                    return SchemaTypeModifiers::NONE;
                case 'add' . $categoryEntityName . 'Metas':
                case 'update' . $categoryEntityName . 'Metas':
                case 'delete' . $categoryEntityName . 'Metas':
                case 'set' . $categoryEntityName . 'Metas':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['add' . $categoryEntityName . 'MetaMutationPayloadObjects', 'update' . $categoryEntityName . 'MetaMutationPayloadObjects', 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects', 'set' . $categoryEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'Meta':
            case 'update' . $categoryEntityName . 'Meta':
            case 'delete' . $categoryEntityName . 'Meta':
            case 'set' . $categoryEntityName . 'Meta':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'add' . $categoryEntityName . 'Metas':
            case 'update' . $categoryEntityName . 'Metas':
            case 'delete' . $categoryEntityName . 'Metas':
            case 'set' . $categoryEntityName . 'Metas':
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
        $categoryEntityName = $this->getCategoryEntityName();
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'Meta':
                return ['input' => $this->getRootAddCategoryTermMetaInputObjectTypeResolver()];
            case 'add' . $categoryEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootAddCategoryTermMetaInputObjectTypeResolver());
            case 'update' . $categoryEntityName . 'Meta':
                return ['input' => $this->getRootUpdateCategoryTermMetaInputObjectTypeResolver()];
            case 'update' . $categoryEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateCategoryTermMetaInputObjectTypeResolver());
            case 'delete' . $categoryEntityName . 'Meta':
                return ['input' => $this->getRootDeleteCategoryTermMetaInputObjectTypeResolver()];
            case 'delete' . $categoryEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteCategoryTermMetaInputObjectTypeResolver());
            case 'set' . $categoryEntityName . 'Meta':
                return ['input' => $this->getRootSetCategoryTermMetaInputObjectTypeResolver()];
            case 'set' . $categoryEntityName . 'Metas':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootSetCategoryTermMetaInputObjectTypeResolver());
            case 'add' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        $categoryEntityName = $this->getCategoryEntityName();
        if (\in_array($fieldName, ['add' . $categoryEntityName . 'MetaMutationPayloadObjects', 'update' . $categoryEntityName . 'MetaMutationPayloadObjects', 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects', 'set' . $categoryEntityName . 'MetaMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['add' . $categoryEntityName . 'Metas', 'update' . $categoryEntityName . 'Metas', 'delete' . $categoryEntityName . 'Metas', 'set' . $categoryEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['add' . $categoryEntityName . 'Meta' => 'input']:
            case ['update' . $categoryEntityName . 'Meta' => 'input']:
            case ['delete' . $categoryEntityName . 'Meta' => 'input']:
            case ['set' . $categoryEntityName . 'Meta' => 'input']:
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
        $categoryEntityName = $this->getCategoryEntityName();
        if (\in_array($fieldName, ['add' . $categoryEntityName . 'Metas', 'update' . $categoryEntityName . 'Metas', 'delete' . $categoryEntityName . 'Metas', 'set' . $categoryEntityName . 'Metas'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        $categoryEntityName = $this->getCategoryEntityName();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'Meta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableAddCategoryTermMetaMutationResolver() : $this->getAddCategoryTermMetaMutationResolver();
            case 'add' . $categoryEntityName . 'Metas':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableAddCategoryTermMetaBulkOperationMutationResolver() : $this->getAddCategoryTermMetaBulkOperationMutationResolver();
            case 'update' . $categoryEntityName . 'Meta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableUpdateCategoryTermMetaMutationResolver() : $this->getUpdateCategoryTermMetaMutationResolver();
            case 'update' . $categoryEntityName . 'Metas':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableUpdateCategoryTermMetaBulkOperationMutationResolver() : $this->getUpdateCategoryTermMetaBulkOperationMutationResolver();
            case 'delete' . $categoryEntityName . 'Meta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableDeleteCategoryTermMetaMutationResolver() : $this->getDeleteCategoryTermMetaMutationResolver();
            case 'delete' . $categoryEntityName . 'Metas':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableDeleteCategoryTermMetaBulkOperationMutationResolver() : $this->getDeleteCategoryTermMetaBulkOperationMutationResolver();
            case 'set' . $categoryEntityName . 'Meta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableSetCategoryTermMetaMutationResolver() : $this->getSetCategoryTermMetaMutationResolver();
            case 'set' . $categoryEntityName . 'Metas':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableSetCategoryTermMetaBulkOperationMutationResolver() : $this->getSetCategoryTermMetaBulkOperationMutationResolver();
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
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        if ($usePayloadableCategoryMetaMutations) {
            return $validationCheckpoints;
        }
        $categoryEntityName = $this->getCategoryEntityName();
        switch ($fieldDataAccessor->getFieldName()) {
            case 'add' . $categoryEntityName . 'Meta':
            case 'add' . $categoryEntityName . 'Metas':
            case 'update' . $categoryEntityName . 'Meta':
            case 'update' . $categoryEntityName . 'Metas':
            case 'delete' . $categoryEntityName . 'Meta':
            case 'delete' . $categoryEntityName . 'Metas':
            case 'set' . $categoryEntityName . 'Meta':
            case 'set' . $categoryEntityName . 'Metas':
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
        $categoryEntityName = $this->getCategoryEntityName();
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'add' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'update' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'delete' . $categoryEntityName . 'MetaMutationPayloadObjects':
            case 'set' . $categoryEntityName . 'MetaMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
