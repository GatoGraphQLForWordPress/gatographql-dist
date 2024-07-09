<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostCategoryMutations\Module;
use PoPCMSSchema\CustomPostCategoryMutations\ModuleConfiguration;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\BulkOperationDecoratorObjectTypeFieldResolverTrait;
use PoPCMSSchema\SchemaCommons\FieldResolvers\ObjectType\MutationPayloadObjectsObjectTypeFieldResolverTrait;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
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
abstract class AbstractRootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver implements \PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType\SetCategoriesOnCustomPostObjectTypeFieldResolverInterface
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    use \PoPCMSSchema\CustomPostCategoryMutations\FieldResolvers\ObjectType\SetCategoriesOnCustomPostObjectTypeFieldResolverTrait;
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
        if ($engineModuleConfiguration->disableRedundantRootTypeMutationFields()) {
            return [];
        }
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $addFieldsToQueryPayloadableCustomPostCategoryMutations = $moduleConfiguration->addFieldsToQueryPayloadableCustomPostCategoryMutations();
        return \array_merge([$this->getSetCategoriesFieldName(), $this->getBulkOperationSetCategoriesFieldName()], $addFieldsToQueryPayloadableCustomPostCategoryMutations ? [$this->getSetCategoriesFieldName() . 'MutationPayloadObjects'] : []);
    }
    protected abstract function getSetCategoriesFieldName() : string;
    protected abstract function getBulkOperationSetCategoriesFieldName() : string;
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case $this->getSetCategoriesFieldName():
                return \sprintf($this->__('Set categories on a %s', 'custompost-category-mutations'), $this->getEntityName());
            case $this->getBulkOperationSetCategoriesFieldName():
                return \sprintf($this->__('Set categories on a %s in bulk', 'custompost-category-mutations'), $this->getEntityName());
            case $this->getSetCategoriesFieldName() . 'MutationPayloadObjects':
                return \sprintf($this->__('Retrieve the payload objects from a recently-executed `%s` mutation', 'post-mutations'), $this->getSetCategoriesFieldName());
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostCategoryMutations = $moduleConfiguration->usePayloadableCustomPostCategoryMutations();
        if (!$usePayloadableCustomPostCategoryMutations) {
            switch ($fieldName) {
                case $this->getSetCategoriesFieldName():
                    return SchemaTypeModifiers::NONE;
                case $this->getBulkOperationSetCategoriesFieldName():
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, [$this->getSetCategoriesFieldName() . 'MutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case $this->getSetCategoriesFieldName():
                return SchemaTypeModifiers::NON_NULLABLE;
            case $this->getBulkOperationSetCategoriesFieldName():
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
            case $this->getSetCategoriesFieldName():
                return ['input' => $this->getCustomPostSetCategoriesInputObjectTypeResolver()];
            case $this->getBulkOperationSetCategoriesFieldName():
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getCustomPostSetCategoriesInputObjectTypeResolver());
            case $this->getSetCategoriesFieldName() . 'MutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, [$this->getSetCategoriesFieldName() . 'MutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, [$this->getBulkOperationSetCategoriesFieldName()])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case [$this->getSetCategoriesFieldName() => 'input']:
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
        if (\in_array($fieldName, [$this->getBulkOperationSetCategoriesFieldName()])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostCategoryMutations = $moduleConfiguration->usePayloadableCustomPostCategoryMutations();
        switch ($fieldName) {
            case $this->getSetCategoriesFieldName():
                return $usePayloadableCustomPostCategoryMutations ? $this->getPayloadableSetCategoriesMutationResolver() : $this->getSetCategoriesMutationResolver();
            case $this->getBulkOperationSetCategoriesFieldName():
                return $usePayloadableCustomPostCategoryMutations ? $this->getPayloadableSetCategoriesBulkOperationMutationResolver() : $this->getSetCategoriesBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostCategoryMutations = $moduleConfiguration->usePayloadableCustomPostCategoryMutations();
        if ($usePayloadableCustomPostCategoryMutations) {
            switch ($fieldName) {
                case $this->getSetCategoriesFieldName():
                case $this->getBulkOperationSetCategoriesFieldName():
                case $this->getSetCategoriesFieldName() . 'MutationPayloadObjects':
                    return $this->getRootSetCategoriesMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case $this->getSetCategoriesFieldName():
            case $this->getBulkOperationSetCategoriesFieldName():
                return $this->getCustomPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    protected abstract function getRootSetCategoriesMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface;
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case $this->getSetCategoriesFieldName() . 'MutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
