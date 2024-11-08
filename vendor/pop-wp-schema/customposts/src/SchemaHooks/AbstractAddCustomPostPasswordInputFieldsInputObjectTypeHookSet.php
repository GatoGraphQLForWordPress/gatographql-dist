<?php

declare(strict_types=1);

namespace PoPWPSchema\CustomPosts\SchemaHooks;

use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\HookNames;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use PoPWPSchema\CustomPosts\FilterInputs\HasPasswordFilterInput;
use PoPWPSchema\CustomPosts\FilterInputs\PasswordFilterInput;

abstract class AbstractAddCustomPostPasswordInputFieldsInputObjectTypeHookSet extends AbstractHookSet
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPWPSchema\CustomPosts\FilterInputs\HasPasswordFilterInput|null
     */
    private $hasPasswordFilterInput;
    /**
     * @var \PoPWPSchema\CustomPosts\FilterInputs\PasswordFilterInput|null
     */
    private $passwordFilterInput;

    final protected function getBooleanScalarTypeResolver(): BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    final protected function getHasPasswordFilterInput(): HasPasswordFilterInput
    {
        if ($this->hasPasswordFilterInput === null) {
            /** @var HasPasswordFilterInput */
            $hasPasswordFilterInput = $this->instanceManager->getInstance(HasPasswordFilterInput::class);
            $this->hasPasswordFilterInput = $hasPasswordFilterInput;
        }
        return $this->hasPasswordFilterInput;
    }
    final protected function getPasswordFilterInput(): PasswordFilterInput
    {
        if ($this->passwordFilterInput === null) {
            /** @var PasswordFilterInput */
            $passwordFilterInput = $this->instanceManager->getInstance(PasswordFilterInput::class);
            $this->passwordFilterInput = $passwordFilterInput;
        }
        return $this->passwordFilterInput;
    }

    protected function init(): void
    {
        App::addFilter(
            HookNames::INPUT_FIELD_NAME_TYPE_RESOLVERS,
            \Closure::fromCallable([$this, 'getInputFieldNameTypeResolvers']),
            10,
            2
        );
        App::addFilter(
            HookNames::SENSITIVE_INPUT_FIELD_NAMES,
            \Closure::fromCallable([$this, 'getSensitiveInputFieldNames']),
            10,
            2
        );
        App::addFilter(
            HookNames::INPUT_FIELD_DESCRIPTION,
            \Closure::fromCallable([$this, 'getInputFieldDescription']),
            10,
            3
        );
        App::addFilter(
            HookNames::INPUT_FIELD_DEFAULT_VALUE,
            \Closure::fromCallable([$this, 'getInputFieldDefaultValue']),
            10,
            3
        );
        App::addFilter(
            HookNames::INPUT_FIELD_FILTER_INPUT,
            \Closure::fromCallable([$this, 'getInputFieldFilterInput']),
            10,
            3
        );
    }

    /**
     * @param array<string,InputTypeResolverInterface> $inputFieldNameTypeResolvers
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(array $inputFieldNameTypeResolvers, InputObjectTypeResolverInterface $inputObjectTypeResolver): array
    {
        if (!$this->isInputObjectTypeResolver($inputObjectTypeResolver)) {
            return $inputFieldNameTypeResolvers;
        }
        return array_merge(
            $inputFieldNameTypeResolvers,
            [
                'hasPassword' => $this->getBooleanScalarTypeResolver(),
                'password' => $this->getStringScalarTypeResolver(),
            ]
        );
    }

    abstract protected function isInputObjectTypeResolver(InputObjectTypeResolverInterface $inputObjectTypeResolver): bool;

    /**
     * @param string[] $inputFieldNames
     * @return string[]
     */
    public function getSensitiveInputFieldNames(array $inputFieldNames, InputObjectTypeResolverInterface $inputObjectTypeResolver): array
    {
        if (!$this->isInputObjectTypeResolver($inputObjectTypeResolver)) {
            return $inputFieldNames;
        }
        return array_merge(
            $inputFieldNames,
            [
                'hasPassword',
                'password',
            ]
        );
    }

    public function getInputFieldDescription(
        ?string $inputFieldDescription,
        InputObjectTypeResolverInterface $inputObjectTypeResolver,
        string $inputFieldName
    ): ?string {
        if (!$this->isInputObjectTypeResolver($inputObjectTypeResolver)) {
            return $inputFieldDescription;
        }
        switch ($inputFieldName) {
            case 'hasPassword':
                return $this->__('Indicate if to include custom posts which are password-protected. Pass `null` to fetch both with/out password', 'customposts');
            case 'password':
                return $this->__('Include custom posts protected by a specific password', 'customposts');
            default:
                return $inputFieldDescription;
        }
    }

    /**
     * @param mixed $inputFieldDefaultValue
     * @return mixed
     */
    public function getInputFieldDefaultValue(
        $inputFieldDefaultValue,
        InputObjectTypeResolverInterface $inputObjectTypeResolver,
        string $inputFieldName
    ) {
        if (!$this->isInputObjectTypeResolver($inputObjectTypeResolver)) {
            return $inputFieldDefaultValue;
        }
        switch ($inputFieldName) {
            case 'hasPassword':
                return false;
            default:
                return $inputFieldDefaultValue;
        }
    }

    public function getInputFieldFilterInput(?FilterInputInterface $inputFieldFilterInput, InputObjectTypeResolverInterface $inputObjectTypeResolver, string $inputFieldName): ?FilterInputInterface
    {
        if (!$this->isInputObjectTypeResolver($inputObjectTypeResolver)) {
            return $inputFieldFilterInput;
        }
        switch ($inputFieldName) {
            case 'hasPassword':
                return $this->getHasPasswordFilterInput();
            case 'password':
                return $this->getPasswordFilterInput();
            default:
                return $inputFieldFilterInput;
        }
    }
}
