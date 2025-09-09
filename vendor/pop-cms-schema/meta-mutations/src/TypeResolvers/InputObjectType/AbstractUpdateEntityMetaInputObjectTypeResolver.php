<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractUpdateEntityMetaInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\UpdateEntityMetaInputObjectTypeResolverInterface
{
    private ?IDScalarTypeResolver $idScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
    private ?AnyScalarScalarTypeResolver $anyScalarScalarTypeResolver = null;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
    protected final function getAnyScalarScalarTypeResolver() : AnyScalarScalarTypeResolver
    {
        if ($this->anyScalarScalarTypeResolver === null) {
            /** @var AnyScalarScalarTypeResolver */
            $anyScalarScalarTypeResolver = $this->instanceManager->getInstance(AnyScalarScalarTypeResolver::class);
            $this->anyScalarScalarTypeResolver = $anyScalarScalarTypeResolver;
        }
        return $this->anyScalarScalarTypeResolver;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update an entity\'s meta', 'meta-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addIDInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::KEY => $this->getStringScalarTypeResolver(), MutationInputProperties::VALUE => $this->getAnyScalarScalarTypeResolver(), MutationInputProperties::PREV_VALUE => $this->getAnyScalarScalarTypeResolver()]);
    }
    protected abstract function addIDInputField() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => $this->__('The ID of the entity', 'meta-mutations'),
            MutationInputProperties::KEY => $this->__('The meta key', 'meta-mutations'),
            MutationInputProperties::VALUE => $this->__('The meta value', 'meta-mutations'),
            MutationInputProperties::PREV_VALUE => $this->__('Previous value to check before updating. If specified, only update existing metadata entries with this value. Otherwise, update all entries', 'meta-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID, MutationInputProperties::KEY, MutationInputProperties::VALUE => SchemaTypeModifiers::MANDATORY,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
}
