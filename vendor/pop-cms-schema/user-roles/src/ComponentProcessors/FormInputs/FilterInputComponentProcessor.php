<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserRoles\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\UserRoles\FilterInputs\ExcludeUserRolesFilterInput;
use PoPCMSSchema\UserRoles\FilterInputs\UserRolesFilterInput;
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_USER_ROLES = 'filterinput-user-roles';
    public const COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES = 'filterinput-exclude-user-roles';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\UserRoles\FilterInputs\UserRolesFilterInput|null
     */
    private $userRolesFilterInput;
    /**
     * @var \PoPCMSSchema\UserRoles\FilterInputs\ExcludeUserRolesFilterInput|null
     */
    private $excludeUserRolesFilterInput;
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
    public final function setUserRolesFilterInput(UserRolesFilterInput $userRolesFilterInput) : void
    {
        $this->userRolesFilterInput = $userRolesFilterInput;
    }
    protected final function getUserRolesFilterInput() : UserRolesFilterInput
    {
        if ($this->userRolesFilterInput === null) {
            /** @var UserRolesFilterInput */
            $userRolesFilterInput = $this->instanceManager->getInstance(UserRolesFilterInput::class);
            $this->userRolesFilterInput = $userRolesFilterInput;
        }
        return $this->userRolesFilterInput;
    }
    public final function setExcludeUserRolesFilterInput(ExcludeUserRolesFilterInput $excludeUserRolesFilterInput) : void
    {
        $this->excludeUserRolesFilterInput = $excludeUserRolesFilterInput;
    }
    protected final function getExcludeUserRolesFilterInput() : ExcludeUserRolesFilterInput
    {
        if ($this->excludeUserRolesFilterInput === null) {
            /** @var ExcludeUserRolesFilterInput */
            $excludeUserRolesFilterInput = $this->instanceManager->getInstance(ExcludeUserRolesFilterInput::class);
            $this->excludeUserRolesFilterInput = $excludeUserRolesFilterInput;
        }
        return $this->excludeUserRolesFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_USER_ROLES, self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_USER_ROLES:
                return $this->getUserRolesFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES:
                return $this->getExcludeUserRolesFilterInput();
            default:
                return null;
        }
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_USER_ROLES:
                return 'roles';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES:
                return 'excludeRoles';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_USER_ROLES:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES:
                return $this->getStringScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_USER_ROLES:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_USER_ROLES:
                return $this->__('Get the users with given roles', 'user-roles');
            case self::COMPONENT_FILTERINPUT_EXCLUDE_USER_ROLES:
                return $this->__('Get the users without the given roles', 'user-roles');
            default:
                return null;
        }
    }
}
