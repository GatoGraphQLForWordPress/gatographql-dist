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
abstract class AbstractDeleteEntityMetaInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\MetaMutations\TypeResolvers\InputObjectType\DeleteEntityMetaInputObjectTypeResolverInterface
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
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\AnyScalarScalarTypeResolver|null
     */
    private $anyScalarScalarTypeResolver;
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
        return $this->__('Input to delete an entity\'s meta entry', 'meta-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addIDInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::KEY => $this->getStringScalarTypeResolver(), MutationInputProperties::VALUE => $this->getAnyScalarScalarTypeResolver()]);
    }
    protected abstract function addIDInputField() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the entity', 'meta-mutations');
            case MutationInputProperties::KEY:
                return $this->__('The meta key', 'meta-mutations');
            case MutationInputProperties::VALUE:
                return $this->__('The specific meta value to delete, to avoid removing duplicate entries for that key', 'meta-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
            case MutationInputProperties::KEY:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
