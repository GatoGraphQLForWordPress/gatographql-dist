<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserRoles\FieldResolvers\ObjectType;

use PoPCMSSchema\UserRoles\Module;
use PoPCMSSchema\UserRoles\ModuleConfiguration;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
/** @internal */
class UserObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface|null
     */
    private $userRoleTypeAPI;
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
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
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
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
    public final function setUserRoleTypeAPI(UserRoleTypeAPIInterface $userRoleTypeAPI) : void
    {
        $this->userRoleTypeAPI = $userRoleTypeAPI;
    }
    protected final function getUserRoleTypeAPI() : UserRoleTypeAPIInterface
    {
        if ($this->userRoleTypeAPI === null) {
            /** @var UserRoleTypeAPIInterface */
            $userRoleTypeAPI = $this->instanceManager->getInstance(UserRoleTypeAPIInterface::class);
            $this->userRoleTypeAPI = $userRoleTypeAPI;
        }
        return $this->userRoleTypeAPI;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [UserObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['roles', 'capabilities', 'hasRole', 'hasAnyRole', 'hasCapability', 'hasAnyCapability'];
    }
    /**
     * @return string[]
     */
    public function getSensitiveFieldNames() : array
    {
        $sensitiveFieldNames = parent::getSensitiveFieldNames();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->treatUserRoleAsSensitiveData()) {
            $sensitiveFieldNames[] = 'roles';
            $sensitiveFieldNames[] = 'hasRole';
            $sensitiveFieldNames[] = 'hasAnyRole';
        }
        if ($moduleConfiguration->treatUserCapabilityAsSensitiveData()) {
            $sensitiveFieldNames[] = 'capabilities';
            $sensitiveFieldNames[] = 'hasCapability';
            $sensitiveFieldNames[] = 'hasAnyCapability';
        }
        return $sensitiveFieldNames;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'roles':
                return $this->getStringScalarTypeResolver();
            case 'capabilities':
                return $this->getStringScalarTypeResolver();
            case 'hasRole':
                return $this->getBooleanScalarTypeResolver();
            case 'hasAnyRole':
                return $this->getBooleanScalarTypeResolver();
            case 'hasCapability':
                return $this->getBooleanScalarTypeResolver();
            case 'hasAnyCapability':
                return $this->getBooleanScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'roles':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            case 'capabilities':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
            case 'hasRole':
            case 'hasAnyRole':
            case 'hasCapability':
            case 'hasAnyCapability':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'roles':
                return $this->__('User roles', 'user-roles');
            case 'capabilities':
                return $this->__('User capabilities', 'user-roles');
            case 'hasRole':
                return $this->__('Does the user have a specific role?', 'user-roles');
            case 'hasAnyRole':
                return $this->__('Does the user have any role from a provided list?', 'user-roles');
            case 'hasCapability':
                return $this->__('Does the user have a specific capability?', 'user-roles');
            case 'hasAnyCapability':
                return $this->__('Does the user have any capability from a provided list?', 'user-roles');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'hasRole':
                return ['role' => $this->getStringScalarTypeResolver()];
            case 'hasAnyRole':
                return ['roles' => $this->getStringScalarTypeResolver()];
            case 'hasCapability':
                return ['capability' => $this->getStringScalarTypeResolver()];
            case 'hasAnyCapability':
                return ['capabilities' => $this->getStringScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['hasRole' => 'role']:
                return $this->__('User role to check against', 'user-roles');
            case ['hasAnyRole' => 'roles']:
                return $this->__('User roles to check against', 'user-roles');
            case ['hasCapability' => 'capability']:
                return $this->__('User capability to check against', 'user-roles');
            case ['hasAnyCapability' => 'capabilities']:
                return $this->__('User capabilities to check against', 'user-roles');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['hasRole' => 'role']:
            case ['hasCapability' => 'capability']:
                return SchemaTypeModifiers::MANDATORY;
            case ['hasAnyRole' => 'roles']:
            case ['hasAnyCapability' => 'capabilities']:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY | SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $user = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'roles':
                return $this->getUserRoleTypeAPI()->getUserRoles($user);
            case 'capabilities':
                return $this->getUserRoleTypeAPI()->getUserCapabilities($user);
            case 'hasRole':
                $userRoles = $this->getUserRoleTypeAPI()->getUserRoles($user);
                return \in_array($fieldDataAccessor->getValue('role'), $userRoles);
            case 'hasAnyRole':
                $userRoles = $this->getUserRoleTypeAPI()->getUserRoles($user);
                return !empty(\array_intersect($fieldDataAccessor->getValue('roles'), $userRoles));
            case 'hasCapability':
                $userCapabilities = $this->getUserRoleTypeAPI()->getUserCapabilities($user);
                return \in_array($fieldDataAccessor->getValue('capability'), $userCapabilities);
            case 'hasAnyCapability':
                $userCapabilities = $this->getUserRoleTypeAPI()->getUserCapabilities($user);
                return !empty(\array_intersect($fieldDataAccessor->getValue('capabilities'), $userCapabilities));
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
