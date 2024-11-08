<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\Module;
use PoPCMSSchema\CategoryMutations\ModuleConfiguration;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\CreateGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermBulkOperationMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootCreateGenericCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootDeleteGenericCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootUpdateGenericCategoryTermInputObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver;
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
class RootGenericCategoryCRUDObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver|null
     */
    private $rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver|null
     */
    private $createGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\CreateGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $createGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver|null
     */
    private $deleteGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $deleteGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver|null
     */
    private $updateGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $updateGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermMutationResolver|null
     */
    private $payloadableDeleteGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableDeleteGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableDeleteGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver|null
     */
    private $payloadableUpdateGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableUpdateGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver|null
     */
    private $payloadableCreateGenericCategoryTermMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermBulkOperationMutationResolver|null
     */
    private $payloadableCreateGenericCategoryTermBulkOperationMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootDeleteGenericCategoryTermInputObjectTypeResolver|null
     */
    private $rootDeleteGenericCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootUpdateGenericCategoryTermInputObjectTypeResolver|null
     */
    private $rootUpdateGenericCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\RootCreateGenericCategoryTermInputObjectTypeResolver|null
     */
    private $rootCreateGenericCategoryTermInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
    }
    protected final function getRootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver() : RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver */
            $rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver = $rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver() : RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver */
            $rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver = $rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getRootCreateGenericCategoryTermMutationPayloadObjectTypeResolver() : RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver
    {
        if ($this->rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver === null) {
            /** @var RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver */
            $rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver::class);
            $this->rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver = $rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver;
        }
        return $this->rootCreateGenericCategoryTermMutationPayloadObjectTypeResolver;
    }
    protected final function getCreateGenericCategoryTermMutationResolver() : CreateGenericCategoryTermMutationResolver
    {
        if ($this->createGenericCategoryTermMutationResolver === null) {
            /** @var CreateGenericCategoryTermMutationResolver */
            $createGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(CreateGenericCategoryTermMutationResolver::class);
            $this->createGenericCategoryTermMutationResolver = $createGenericCategoryTermMutationResolver;
        }
        return $this->createGenericCategoryTermMutationResolver;
    }
    protected final function getCreateGenericCategoryTermBulkOperationMutationResolver() : CreateGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->createGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var CreateGenericCategoryTermBulkOperationMutationResolver */
            $createGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(CreateGenericCategoryTermBulkOperationMutationResolver::class);
            $this->createGenericCategoryTermBulkOperationMutationResolver = $createGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->createGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getDeleteGenericCategoryTermMutationResolver() : DeleteGenericCategoryTermMutationResolver
    {
        if ($this->deleteGenericCategoryTermMutationResolver === null) {
            /** @var DeleteGenericCategoryTermMutationResolver */
            $deleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(DeleteGenericCategoryTermMutationResolver::class);
            $this->deleteGenericCategoryTermMutationResolver = $deleteGenericCategoryTermMutationResolver;
        }
        return $this->deleteGenericCategoryTermMutationResolver;
    }
    protected final function getDeleteGenericCategoryTermBulkOperationMutationResolver() : DeleteGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->deleteGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var DeleteGenericCategoryTermBulkOperationMutationResolver */
            $deleteGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(DeleteGenericCategoryTermBulkOperationMutationResolver::class);
            $this->deleteGenericCategoryTermBulkOperationMutationResolver = $deleteGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->deleteGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getUpdateGenericCategoryTermMutationResolver() : UpdateGenericCategoryTermMutationResolver
    {
        if ($this->updateGenericCategoryTermMutationResolver === null) {
            /** @var UpdateGenericCategoryTermMutationResolver */
            $updateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(UpdateGenericCategoryTermMutationResolver::class);
            $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
        }
        return $this->updateGenericCategoryTermMutationResolver;
    }
    protected final function getUpdateGenericCategoryTermBulkOperationMutationResolver() : UpdateGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->updateGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var UpdateGenericCategoryTermBulkOperationMutationResolver */
            $updateGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(UpdateGenericCategoryTermBulkOperationMutationResolver::class);
            $this->updateGenericCategoryTermBulkOperationMutationResolver = $updateGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->updateGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableDeleteGenericCategoryTermMutationResolver() : PayloadableDeleteGenericCategoryTermMutationResolver
    {
        if ($this->payloadableDeleteGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableDeleteGenericCategoryTermMutationResolver */
            $payloadableDeleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericCategoryTermMutationResolver::class);
            $this->payloadableDeleteGenericCategoryTermMutationResolver = $payloadableDeleteGenericCategoryTermMutationResolver;
        }
        return $this->payloadableDeleteGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableDeleteGenericCategoryTermBulkOperationMutationResolver() : PayloadableDeleteGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableDeleteGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableDeleteGenericCategoryTermBulkOperationMutationResolver */
            $payloadableDeleteGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteGenericCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableDeleteGenericCategoryTermBulkOperationMutationResolver = $payloadableDeleteGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableDeleteGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCategoryTermMutationResolver() : PayloadableUpdateGenericCategoryTermMutationResolver
    {
        if ($this->payloadableUpdateGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericCategoryTermMutationResolver */
            $payloadableUpdateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCategoryTermMutationResolver::class);
            $this->payloadableUpdateGenericCategoryTermMutationResolver = $payloadableUpdateGenericCategoryTermMutationResolver;
        }
        return $this->payloadableUpdateGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCategoryTermBulkOperationMutationResolver() : PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableUpdateGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver */
            $payloadableUpdateGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableUpdateGenericCategoryTermBulkOperationMutationResolver = $payloadableUpdateGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableUpdateGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getPayloadableCreateGenericCategoryTermMutationResolver() : PayloadableCreateGenericCategoryTermMutationResolver
    {
        if ($this->payloadableCreateGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableCreateGenericCategoryTermMutationResolver */
            $payloadableCreateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericCategoryTermMutationResolver::class);
            $this->payloadableCreateGenericCategoryTermMutationResolver = $payloadableCreateGenericCategoryTermMutationResolver;
        }
        return $this->payloadableCreateGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableCreateGenericCategoryTermBulkOperationMutationResolver() : PayloadableCreateGenericCategoryTermBulkOperationMutationResolver
    {
        if ($this->payloadableCreateGenericCategoryTermBulkOperationMutationResolver === null) {
            /** @var PayloadableCreateGenericCategoryTermBulkOperationMutationResolver */
            $payloadableCreateGenericCategoryTermBulkOperationMutationResolver = $this->instanceManager->getInstance(PayloadableCreateGenericCategoryTermBulkOperationMutationResolver::class);
            $this->payloadableCreateGenericCategoryTermBulkOperationMutationResolver = $payloadableCreateGenericCategoryTermBulkOperationMutationResolver;
        }
        return $this->payloadableCreateGenericCategoryTermBulkOperationMutationResolver;
    }
    protected final function getRootDeleteGenericCategoryTermInputObjectTypeResolver() : RootDeleteGenericCategoryTermInputObjectTypeResolver
    {
        if ($this->rootDeleteGenericCategoryTermInputObjectTypeResolver === null) {
            /** @var RootDeleteGenericCategoryTermInputObjectTypeResolver */
            $rootDeleteGenericCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCategoryTermInputObjectTypeResolver::class);
            $this->rootDeleteGenericCategoryTermInputObjectTypeResolver = $rootDeleteGenericCategoryTermInputObjectTypeResolver;
        }
        return $this->rootDeleteGenericCategoryTermInputObjectTypeResolver;
    }
    protected final function getRootUpdateGenericCategoryTermInputObjectTypeResolver() : RootUpdateGenericCategoryTermInputObjectTypeResolver
    {
        if ($this->rootUpdateGenericCategoryTermInputObjectTypeResolver === null) {
            /** @var RootUpdateGenericCategoryTermInputObjectTypeResolver */
            $rootUpdateGenericCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCategoryTermInputObjectTypeResolver::class);
            $this->rootUpdateGenericCategoryTermInputObjectTypeResolver = $rootUpdateGenericCategoryTermInputObjectTypeResolver;
        }
        return $this->rootUpdateGenericCategoryTermInputObjectTypeResolver;
    }
    protected final function getRootCreateGenericCategoryTermInputObjectTypeResolver() : RootCreateGenericCategoryTermInputObjectTypeResolver
    {
        if ($this->rootCreateGenericCategoryTermInputObjectTypeResolver === null) {
            /** @var RootCreateGenericCategoryTermInputObjectTypeResolver */
            $rootCreateGenericCategoryTermInputObjectTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCategoryTermInputObjectTypeResolver::class);
            $this->rootCreateGenericCategoryTermInputObjectTypeResolver = $rootCreateGenericCategoryTermInputObjectTypeResolver;
        }
        return $this->rootCreateGenericCategoryTermInputObjectTypeResolver;
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
        $addFieldsToQueryPayloadableCategoryMutations = $moduleConfiguration->addFieldsToQueryPayloadableCategoryMutations();
        return \array_merge(['createCategory', 'createCategories'], !$disableRedundantRootTypeMutationFields ? ['updateCategory', 'updateCategories', 'deleteCategory', 'deleteCategories'] : [], $addFieldsToQueryPayloadableCategoryMutations ? ['createCategoryMutationPayloadObjects'] : [], $addFieldsToQueryPayloadableCategoryMutations && !$disableRedundantRootTypeMutationFields ? ['updateCategoryMutationPayloadObjects', 'deleteCategoryMutationPayloadObjects'] : []);
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'createCategory':
                return $this->__('Create a category', 'category-mutations');
            case 'createCategories':
                return $this->__('Create categories', 'category-mutations');
            case 'updateCategory':
                return $this->__('Update a category', 'category-mutations');
            case 'updateCategories':
                return $this->__('Update categories', 'category-mutations');
            case 'deleteCategory':
                return $this->__('Delete a category', 'category-mutations');
            case 'deleteCategories':
                return $this->__('Delete categories', 'category-mutations');
            case 'createCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `createCategory` mutation', 'category-mutations');
            case 'updateCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `updateCategory` mutation', 'category-mutations');
            case 'deleteCategoryMutationPayloadObjects':
                return $this->__('Retrieve the payload objects from a recently-executed `deleteCategory` mutation', 'category-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if (!$usePayloadableCategoryMutations) {
            switch ($fieldName) {
                case 'createCategory':
                case 'updateCategory':
                case 'deleteCategory':
                    return SchemaTypeModifiers::NONE;
                case 'createCategories':
                case 'updateCategories':
                case 'deleteCategories':
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, ['createCategoryMutationPayloadObjects', 'updateCategoryMutationPayloadObjects', 'deleteCategoryMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case 'createCategory':
            case 'updateCategory':
            case 'deleteCategory':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'createCategories':
            case 'updateCategories':
            case 'deleteCategories':
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
            case 'createCategory':
                return ['input' => $this->getRootCreateGenericCategoryTermInputObjectTypeResolver()];
            case 'createCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootCreateGenericCategoryTermInputObjectTypeResolver());
            case 'updateCategory':
                return ['input' => $this->getRootUpdateGenericCategoryTermInputObjectTypeResolver()];
            case 'updateCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootUpdateGenericCategoryTermInputObjectTypeResolver());
            case 'deleteCategory':
                return ['input' => $this->getRootDeleteGenericCategoryTermInputObjectTypeResolver()];
            case 'deleteCategories':
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getRootDeleteGenericCategoryTermInputObjectTypeResolver());
            case 'createCategoryMutationPayloadObjects':
            case 'updateCategoryMutationPayloadObjects':
            case 'deleteCategoryMutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, ['createCategoryMutationPayloadObjects', 'updateCategoryMutationPayloadObjects', 'deleteCategoryMutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, ['createCategories', 'updateCategories', 'deleteCategories'])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case ['createCategory' => 'input']:
            case ['updateCategory' => 'input']:
            case ['deleteCategory' => 'input']:
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
        if (\in_array($fieldName, ['createCategories', 'updateCategories', 'deleteCategories'])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        switch ($fieldName) {
            case 'createCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableCreateGenericCategoryTermMutationResolver() : $this->getCreateGenericCategoryTermMutationResolver();
            case 'createCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableCreateGenericCategoryTermBulkOperationMutationResolver() : $this->getCreateGenericCategoryTermBulkOperationMutationResolver();
            case 'updateCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdateGenericCategoryTermMutationResolver() : $this->getUpdateGenericCategoryTermMutationResolver();
            case 'updateCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableUpdateGenericCategoryTermBulkOperationMutationResolver() : $this->getUpdateGenericCategoryTermBulkOperationMutationResolver();
            case 'deleteCategory':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeleteGenericCategoryTermMutationResolver() : $this->getDeleteGenericCategoryTermMutationResolver();
            case 'deleteCategories':
                return $usePayloadableCategoryMutations ? $this->getPayloadableDeleteGenericCategoryTermBulkOperationMutationResolver() : $this->getDeleteGenericCategoryTermBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if ($usePayloadableCategoryMutations) {
            switch ($fieldName) {
                case 'createCategory':
                case 'createCategories':
                case 'createCategoryMutationPayloadObjects':
                    return $this->getRootCreateGenericCategoryTermMutationPayloadObjectTypeResolver();
                case 'updateCategory':
                case 'updateCategories':
                case 'updateCategoryMutationPayloadObjects':
                    return $this->getRootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver();
                case 'deleteCategory':
                case 'deleteCategories':
                case 'deleteCategoryMutationPayloadObjects':
                    return $this->getRootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'createCategory':
            case 'createCategories':
            case 'updateCategory':
            case 'updateCategories':
                return $this->getGenericCategoryObjectTypeResolver();
            case 'deleteCategory':
            case 'deleteCategories':
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
        $usePayloadableCategoryMutations = $moduleConfiguration->usePayloadableCategoryMutations();
        if ($usePayloadableCategoryMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'createCategory':
            case 'createCategories':
            case 'updateCategory':
            case 'updateCategories':
            case 'deleteCategory':
            case 'deleteCategories':
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
            case 'createCategoryMutationPayloadObjects':
            case 'updateCategoryMutationPayloadObjects':
            case 'deleteCategoryMutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
