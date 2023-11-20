<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Root\App;
use PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput;
use PoPCMSSchema\Users\Constants\InputProperties;
use PoPCMSSchema\Users\FilterInputs\EmailFilterInput;
use PoPCMSSchema\Users\FilterInputs\UsernameFilterInput;
use PoPCMSSchema\Users\Module;
use PoPCMSSchema\Users\ModuleConfiguration;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
/** @internal */
class UserByOneofInputObjectTypeResolver extends AbstractOneofQueryableInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver|null
     */
    private $emailScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput|null
     */
    private $includeFilterInput;
    /**
     * @var \PoPCMSSchema\Users\FilterInputs\UsernameFilterInput|null
     */
    private $usernameFilterInput;
    /**
     * @var \PoPCMSSchema\Users\FilterInputs\EmailFilterInput|null
     */
    private $emailFilterInput;
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
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
    public final function setEmailScalarTypeResolver(EmailScalarTypeResolver $emailScalarTypeResolver) : void
    {
        $this->emailScalarTypeResolver = $emailScalarTypeResolver;
    }
    protected final function getEmailScalarTypeResolver() : EmailScalarTypeResolver
    {
        if ($this->emailScalarTypeResolver === null) {
            /** @var EmailScalarTypeResolver */
            $emailScalarTypeResolver = $this->instanceManager->getInstance(EmailScalarTypeResolver::class);
            $this->emailScalarTypeResolver = $emailScalarTypeResolver;
        }
        return $this->emailScalarTypeResolver;
    }
    public final function setIncludeFilterInput(IncludeFilterInput $includeFilterInput) : void
    {
        $this->includeFilterInput = $includeFilterInput;
    }
    protected final function getIncludeFilterInput() : IncludeFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var IncludeFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(IncludeFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    public final function setUsernameFilterInput(UsernameFilterInput $usernameFilterInput) : void
    {
        $this->usernameFilterInput = $usernameFilterInput;
    }
    protected final function getUsernameFilterInput() : UsernameFilterInput
    {
        if ($this->usernameFilterInput === null) {
            /** @var UsernameFilterInput */
            $usernameFilterInput = $this->instanceManager->getInstance(UsernameFilterInput::class);
            $this->usernameFilterInput = $usernameFilterInput;
        }
        return $this->usernameFilterInput;
    }
    public final function setEmailFilterInput(EmailFilterInput $emailFilterInput) : void
    {
        $this->emailFilterInput = $emailFilterInput;
    }
    protected final function getEmailFilterInput() : EmailFilterInput
    {
        if ($this->emailFilterInput === null) {
            /** @var EmailFilterInput */
            $emailFilterInput = $this->instanceManager->getInstance(EmailFilterInput::class);
            $this->emailFilterInput = $emailFilterInput;
        }
        return $this->emailFilterInput;
    }
    public function getTypeName() : string
    {
        return 'UserByInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Oneof input to specify the property and data to fetch a user', 'users');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [InputProperties::ID => $this->getIDScalarTypeResolver(), InputProperties::USERNAME => $this->getStringScalarTypeResolver(), InputProperties::EMAIL => $this->getEmailScalarTypeResolver()];
    }
    /**
     * @return string[]
     */
    public function getSensitiveInputFieldNames() : array
    {
        $sensitiveInputFieldNames = parent::getSensitiveInputFieldNames();
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->treatUserEmailAsSensitiveData()) {
            $sensitiveInputFieldNames[] = InputProperties::EMAIL;
        }
        return $sensitiveInputFieldNames;
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->__('Query by user ID', 'users');
            case InputProperties::USERNAME:
                return $this->__('Query by username', 'users');
            case InputProperties::EMAIL:
                return $this->__('Query by email', 'users');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->getIncludeFilterInput();
            case InputProperties::USERNAME:
                return $this->getUsernameFilterInput();
            case InputProperties::EMAIL:
                return $this->getEmailFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
