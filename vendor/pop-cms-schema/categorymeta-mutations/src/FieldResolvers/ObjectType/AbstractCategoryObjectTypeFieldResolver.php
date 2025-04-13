<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMetaMutations\Module;
use PoPCMSSchema\CategoryMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermAddMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermDeleteMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermSetMetaInputObjectTypeResolver;
use PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermUpdateMetaInputObjectTypeResolver;
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
abstract class AbstractCategoryObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermAddMetaInputObjectTypeResolver|null
     */
    private $categoryTermAddMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermDeleteMetaInputObjectTypeResolver|null
     */
    private $categoryTermDeleteMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermSetMetaInputObjectTypeResolver|null
     */
    private $categoryTermSetMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\CategoryTermUpdateMetaInputObjectTypeResolver|null
     */
    private $categoryTermUpdateMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver|null
     */
    private $addCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver|null
     */
    private $deleteCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver|null
     */
    private $setCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver|null
     */
    private $updateCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver|null
     */
    private $payloadableDeleteCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver|null
     */
    private $payloadableSetCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver|null
     */
    private $payloadableUpdateCategoryTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver|null
     */
    private $payloadableAddCategoryTermMetaMutationResolver;
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    protected final function getCategoryTermAddMetaInputObjectTypeResolver() : CategoryTermAddMetaInputObjectTypeResolver
    {
        if ($this->categoryTermAddMetaInputObjectTypeResolver === null) {
            /** @var CategoryTermAddMetaInputObjectTypeResolver */
            $categoryTermAddMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryTermAddMetaInputObjectTypeResolver::class);
            $this->categoryTermAddMetaInputObjectTypeResolver = $categoryTermAddMetaInputObjectTypeResolver;
        }
        return $this->categoryTermAddMetaInputObjectTypeResolver;
    }
    protected final function getCategoryTermDeleteMetaInputObjectTypeResolver() : CategoryTermDeleteMetaInputObjectTypeResolver
    {
        if ($this->categoryTermDeleteMetaInputObjectTypeResolver === null) {
            /** @var CategoryTermDeleteMetaInputObjectTypeResolver */
            $categoryTermDeleteMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryTermDeleteMetaInputObjectTypeResolver::class);
            $this->categoryTermDeleteMetaInputObjectTypeResolver = $categoryTermDeleteMetaInputObjectTypeResolver;
        }
        return $this->categoryTermDeleteMetaInputObjectTypeResolver;
    }
    protected final function getCategoryTermSetMetaInputObjectTypeResolver() : CategoryTermSetMetaInputObjectTypeResolver
    {
        if ($this->categoryTermSetMetaInputObjectTypeResolver === null) {
            /** @var CategoryTermSetMetaInputObjectTypeResolver */
            $categoryTermSetMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryTermSetMetaInputObjectTypeResolver::class);
            $this->categoryTermSetMetaInputObjectTypeResolver = $categoryTermSetMetaInputObjectTypeResolver;
        }
        return $this->categoryTermSetMetaInputObjectTypeResolver;
    }
    protected final function getCategoryTermUpdateMetaInputObjectTypeResolver() : CategoryTermUpdateMetaInputObjectTypeResolver
    {
        if ($this->categoryTermUpdateMetaInputObjectTypeResolver === null) {
            /** @var CategoryTermUpdateMetaInputObjectTypeResolver */
            $categoryTermUpdateMetaInputObjectTypeResolver = $this->instanceManager->getInstance(CategoryTermUpdateMetaInputObjectTypeResolver::class);
            $this->categoryTermUpdateMetaInputObjectTypeResolver = $categoryTermUpdateMetaInputObjectTypeResolver;
        }
        return $this->categoryTermUpdateMetaInputObjectTypeResolver;
    }
    protected final function getAddCategoryTermMetaMutationResolver() : AddCategoryTermMetaMutationResolver
    {
        if ($this->addCategoryTermMetaMutationResolver === null) {
            /** @var AddCategoryTermMetaMutationResolver */
            $addCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(AddCategoryTermMetaMutationResolver::class);
            $this->addCategoryTermMetaMutationResolver = $addCategoryTermMetaMutationResolver;
        }
        return $this->addCategoryTermMetaMutationResolver;
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
    protected final function getSetCategoryTermMetaMutationResolver() : SetCategoryTermMetaMutationResolver
    {
        if ($this->setCategoryTermMetaMutationResolver === null) {
            /** @var SetCategoryTermMetaMutationResolver */
            $setCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(SetCategoryTermMetaMutationResolver::class);
            $this->setCategoryTermMetaMutationResolver = $setCategoryTermMetaMutationResolver;
        }
        return $this->setCategoryTermMetaMutationResolver;
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
    protected final function getPayloadableDeleteCategoryTermMetaMutationResolver() : PayloadableDeleteCategoryTermMetaMutationResolver
    {
        if ($this->payloadableDeleteCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteCategoryTermMetaMutationResolver */
            $payloadableDeleteCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteCategoryTermMetaMutationResolver::class);
            $this->payloadableDeleteCategoryTermMetaMutationResolver = $payloadableDeleteCategoryTermMetaMutationResolver;
        }
        return $this->payloadableDeleteCategoryTermMetaMutationResolver;
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
    protected final function getPayloadableUpdateCategoryTermMetaMutationResolver() : PayloadableUpdateCategoryTermMetaMutationResolver
    {
        if ($this->payloadableUpdateCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateCategoryTermMetaMutationResolver */
            $payloadableUpdateCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateCategoryTermMetaMutationResolver::class);
            $this->payloadableUpdateCategoryTermMetaMutationResolver = $payloadableUpdateCategoryTermMetaMutationResolver;
        }
        return $this->payloadableUpdateCategoryTermMetaMutationResolver;
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
                return $this->__('Add a category term meta entry', 'categorymeta-mutations');
            case 'deleteMeta':
                return $this->__('Delete a category term meta entry', 'categorymeta-mutations');
            case 'setMeta':
                return $this->__('Set meta entries to a a category term', 'categorymeta-mutations');
            case 'updateMeta':
                return $this->__('Update a category term meta entry', 'categorymeta-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        if (!$usePayloadableCategoryMetaMutations) {
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
                return ['input' => $this->getCategoryTermAddMetaInputObjectTypeResolver()];
            case 'deleteMeta':
                return ['input' => $this->getCategoryTermDeleteMetaInputObjectTypeResolver()];
            case 'setMeta':
                return ['input' => $this->getCategoryTermSetMetaInputObjectTypeResolver()];
            case 'updateMeta':
                return ['input' => $this->getCategoryTermUpdateMetaInputObjectTypeResolver()];
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
        $category = $object;
        switch ($field->getName()) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::ID} = $objectTypeResolver->getID($category);
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCategoryMetaMutations = $moduleConfiguration->usePayloadableCategoryMetaMutations();
        switch ($fieldName) {
            case 'addMeta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableAddCategoryTermMetaMutationResolver() : $this->getAddCategoryTermMetaMutationResolver();
            case 'updateMeta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableUpdateCategoryTermMetaMutationResolver() : $this->getUpdateCategoryTermMetaMutationResolver();
            case 'deleteMeta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableDeleteCategoryTermMetaMutationResolver() : $this->getDeleteCategoryTermMetaMutationResolver();
            case 'setMeta':
                return $usePayloadableCategoryMetaMutations ? $this->getPayloadableSetCategoryTermMetaMutationResolver() : $this->getSetCategoryTermMetaMutationResolver();
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
