<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Users\FilterInputs\EmailOrEmailsFilterInput;
use PoPCMSSchema\Users\FilterInputs\NameFilterInput;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_NAME = 'filterinput-name';
    public const COMPONENT_FILTERINPUT_EMAILS = 'filterinput-emails';
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver|null
     */
    private $emailScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Users\FilterInputs\NameFilterInput|null
     */
    private $nameFilterInput;
    /**
     * @var \PoPCMSSchema\Users\FilterInputs\EmailOrEmailsFilterInput|null
     */
    private $emailOrEmailsFilterInput;
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
    public final function setNameFilterInput(NameFilterInput $nameFilterInput) : void
    {
        $this->nameFilterInput = $nameFilterInput;
    }
    protected final function getNameFilterInput() : NameFilterInput
    {
        if ($this->nameFilterInput === null) {
            /** @var NameFilterInput */
            $nameFilterInput = $this->instanceManager->getInstance(NameFilterInput::class);
            $this->nameFilterInput = $nameFilterInput;
        }
        return $this->nameFilterInput;
    }
    public final function setEmailOrEmailsFilterInput(EmailOrEmailsFilterInput $emailOrEmailsFilterInput) : void
    {
        $this->emailOrEmailsFilterInput = $emailOrEmailsFilterInput;
    }
    protected final function getEmailOrEmailsFilterInput() : EmailOrEmailsFilterInput
    {
        if ($this->emailOrEmailsFilterInput === null) {
            /** @var EmailOrEmailsFilterInput */
            $emailOrEmailsFilterInput = $this->instanceManager->getInstance(EmailOrEmailsFilterInput::class);
            $this->emailOrEmailsFilterInput = $emailOrEmailsFilterInput;
        }
        return $this->emailOrEmailsFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_NAME, self::COMPONENT_FILTERINPUT_EMAILS);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_NAME:
                return $this->getNameFilterInput();
            case self::COMPONENT_FILTERINPUT_EMAILS:
                return $this->getEmailOrEmailsFilterInput();
            default:
                return null;
        }
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_NAME:
            case self::COMPONENT_FILTERINPUT_EMAILS:
                // Add a nice name, so that the URL params when filtering make sense
                $names = array(self::COMPONENT_FILTERINPUT_NAME => 'nombre', self::COMPONENT_FILTERINPUT_EMAILS => 'emails');
                return $names[$component->name];
        }
        return parent::getName($component);
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_NAME:
                return $this->getStringScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EMAILS:
                return $this->getEmailScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_EMAILS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_NAME:
                return $this->__('Search users whose name contains this string', 'pop-users');
            case self::COMPONENT_FILTERINPUT_EMAILS:
                return $this->__('Search users with any of the provided emails', 'pop-users');
            default:
                return null;
        }
    }
}
