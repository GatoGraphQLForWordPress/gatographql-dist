<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostTagMutations\Module;
use PoPCMSSchema\CustomPostTagMutations\ModuleConfiguration;
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
abstract class AbstractRootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver implements \PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType\SetTagsOnCustomPostObjectTypeFieldResolverInterface
{
    use MutationPayloadObjectsObjectTypeFieldResolverTrait;
    use BulkOperationDecoratorObjectTypeFieldResolverTrait;
    use \PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType\SetTagsOnCustomPostObjectTypeFieldResolverTrait;
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
        $addFieldsToQueryPayloadableCustomPostTagMutations = $moduleConfiguration->addFieldsToQueryPayloadableCustomPostTagMutations();
        return \array_merge([$this->getSetTagsFieldName(), $this->getBulkOperationSetTagsFieldName()], $addFieldsToQueryPayloadableCustomPostTagMutations ? [$this->getSetTagsFieldName() . 'MutationPayloadObjects'] : []);
    }
    protected abstract function getSetTagsFieldName() : string;
    protected abstract function getBulkOperationSetTagsFieldName() : string;
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case $this->getSetTagsFieldName():
                return \sprintf($this->__('Set tags on a %s', 'custompost-tag-mutations'), $this->getEntityName());
            case $this->getBulkOperationSetTagsFieldName():
                return \sprintf($this->__('Set tags on a %s in bulk', 'custompost-tag-mutations'), $this->getEntityName());
            case $this->getSetTagsFieldName() . 'MutationPayloadObjects':
                return \sprintf($this->__('Retrieve the payload objects from a recently-executed `%s` mutation', 'custompost-tag-mutations'), $this->getSetTagsFieldName());
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostTagMutations = $moduleConfiguration->usePayloadableCustomPostTagMutations();
        if (!$usePayloadableCustomPostTagMutations) {
            switch ($fieldName) {
                case $this->getSetTagsFieldName():
                    return SchemaTypeModifiers::NONE;
                case $this->getBulkOperationSetTagsFieldName():
                    return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        if (\in_array($fieldName, [$this->getSetTagsFieldName() . 'MutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldTypeModifiers();
        }
        switch ($fieldName) {
            case $this->getSetTagsFieldName():
                return SchemaTypeModifiers::NON_NULLABLE;
            case $this->getBulkOperationSetTagsFieldName():
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
            case $this->getSetTagsFieldName():
                return ['input' => $this->getCustomPostSetTagsInputObjectTypeResolver()];
            case $this->getBulkOperationSetTagsFieldName():
                return $this->getBulkOperationFieldArgNameTypeResolvers($this->getCustomPostSetTagsInputObjectTypeResolver());
            case $this->getSetTagsFieldName() . 'MutationPayloadObjects':
                return $this->getMutationPayloadObjectsFieldArgNameTypeResolvers();
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        if (\in_array($fieldName, [$this->getSetTagsFieldName() . 'MutationPayloadObjects'])) {
            return $this->getMutationPayloadObjectsFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        if (\in_array($fieldName, [$this->getBulkOperationSetTagsFieldName()])) {
            return $this->getBulkOperationFieldArgTypeModifiers($fieldArgName) ?? parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
        switch ([$fieldName => $fieldArgName]) {
            case [$this->getSetTagsFieldName() => 'input']:
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
        if (\in_array($fieldName, [$this->getBulkOperationSetTagsFieldName()])) {
            return $this->getBulkOperationFieldArgDefaultValue($fieldArgName) ?? parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostTagMutations = $moduleConfiguration->usePayloadableCustomPostTagMutations();
        switch ($fieldName) {
            case $this->getSetTagsFieldName():
                return $usePayloadableCustomPostTagMutations ? $this->getPayloadableSetTagsMutationResolver() : $this->getSetTagsMutationResolver();
            case $this->getBulkOperationSetTagsFieldName():
                return $usePayloadableCustomPostTagMutations ? $this->getPayloadableSetTagsBulkOperationMutationResolver() : $this->getSetTagsBulkOperationMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostTagMutations = $moduleConfiguration->usePayloadableCustomPostTagMutations();
        if ($usePayloadableCustomPostTagMutations) {
            switch ($fieldName) {
                case $this->getSetTagsFieldName():
                case $this->getBulkOperationSetTagsFieldName():
                case $this->getSetTagsFieldName() . 'MutationPayloadObjects':
                    return $this->getRootSetTagsMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case $this->getSetTagsFieldName():
            case $this->getBulkOperationSetTagsFieldName():
                return $this->getCustomPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    protected abstract function getRootSetTagsMutationPayloadObjectTypeResolver() : ConcreteTypeResolverInterface;
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case $this->getSetTagsFieldName() . 'MutationPayloadObjects':
                return $this->resolveMutationPayloadObjectsValue($objectTypeResolver, $fieldDataAccessor);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
