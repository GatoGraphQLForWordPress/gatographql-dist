<?php

declare (strict_types=1);
namespace PoPCMSSchema\Settings\FieldResolvers\ObjectType;

use PoPCMSSchema\Settings\FeedbackItemProviders\FeedbackItemProvider;
use PoPCMSSchema\Settings\TypeAPIs\SettingsTypeAPIInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver;
/** @internal */
class RootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver|null
     */
    private $anyBuiltInScalarScalarTypeResolver;
    /**
     * @var \PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver|null
     */
    private $jsonObjectScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Settings\TypeAPIs\SettingsTypeAPIInterface|null
     */
    private $settingsTypeAPI;
    protected final function getAnyBuiltInScalarScalarTypeResolver() : AnyBuiltInScalarScalarTypeResolver
    {
        if ($this->anyBuiltInScalarScalarTypeResolver === null) {
            /** @var AnyBuiltInScalarScalarTypeResolver */
            $anyBuiltInScalarScalarTypeResolver = $this->instanceManager->getInstance(AnyBuiltInScalarScalarTypeResolver::class);
            $this->anyBuiltInScalarScalarTypeResolver = $anyBuiltInScalarScalarTypeResolver;
        }
        return $this->anyBuiltInScalarScalarTypeResolver;
    }
    protected final function getJSONObjectScalarTypeResolver() : JSONObjectScalarTypeResolver
    {
        if ($this->jsonObjectScalarTypeResolver === null) {
            /** @var JSONObjectScalarTypeResolver */
            $jsonObjectScalarTypeResolver = $this->instanceManager->getInstance(JSONObjectScalarTypeResolver::class);
            $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
        }
        return $this->jsonObjectScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getSettingsTypeAPI() : SettingsTypeAPIInterface
    {
        if ($this->settingsTypeAPI === null) {
            /** @var SettingsTypeAPIInterface */
            $settingsTypeAPI = $this->instanceManager->getInstance(SettingsTypeAPIInterface::class);
            $this->settingsTypeAPI = $settingsTypeAPI;
        }
        return $this->settingsTypeAPI;
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
        return ['optionValue', 'optionValues', 'optionObjectValue', 'optionObjectValues'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'optionValue':
                return $this->__('Single-value option saved in the DB, of any built-in scalar type, or `null` if entry does not exist', 'pop-settings');
            case 'optionValues':
                return $this->__('Array-value option saved in the DB, of any built-in scalar type, or `null` if entry does not exist', 'pop-settings');
            case 'optionObjectValue':
                return $this->__('Object-value option saved in the DB, or `null` if entry does not exist', 'pop-settings');
            case 'optionObjectValues':
                return $this->__('Array of object-value options saved in the DB, or `null` if entry does not exist', 'pop-settings');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'optionValue':
                return $this->getStringScalarTypeResolver();
            case 'optionValues':
                return $this->getAnyBuiltInScalarScalarTypeResolver();
            case 'optionObjectValue':
                return $this->getJSONObjectScalarTypeResolver();
            case 'optionObjectValues':
                return $this->getJSONObjectScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'optionValues':
            case 'optionObjectValues':
                return SchemaTypeModifiers::IS_ARRAY;
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
            case 'optionValue':
            case 'optionValues':
            case 'optionObjectValue':
            case 'optionObjectValues':
                return ['name' => $this->getStringScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ($fieldArgName) {
            case 'name':
                return $this->__('The option name', 'pop-settings');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ($fieldArgName) {
            case 'name':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * Custom validations
     */
    public function validateFieldKeyValues(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::validateFieldKeyValues($objectTypeResolver, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'optionValue':
            case 'optionValues':
            case 'optionObjectValue':
            case 'optionObjectValues':
                if (!$this->getSettingsTypeAPI()->validateIsOptionAllowed($fieldDataAccessor->getValue('name'))) {
                    $field = $fieldDataAccessor->getField();
                    $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E1, [$fieldDataAccessor->getValue('name')]), $field->getArgument('name') ?? $field));
                }
                break;
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'optionValue':
            case 'optionValues':
            case 'optionObjectValue':
            case 'optionObjectValues':
                $value = $this->getSettingsTypeAPI()->getOption($fieldDataAccessor->getValue('name'));
                if ($value === null) {
                    return null;
                }
                if ($fieldDataAccessor->getFieldName() === 'optionValues') {
                    // Make sure keys are ints, not strings, otherwise it's an object
                    return \array_values($value);
                }
                if ($fieldDataAccessor->getFieldName() === 'optionObjectValue') {
                    return \is_array($value) ? (object) $value : $value;
                }
                if ($fieldDataAccessor->getFieldName() === 'optionObjectValues') {
                    return \array_values(\array_map(function ($valueItem) {
                        return \is_array($valueItem) ? (object) $valueItem : $valueItem;
                    }, $value));
                }
                return $value;
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
