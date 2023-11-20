<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractFilterInputComponentProcessor extends \PoP\ComponentModel\ComponentProcessors\AbstractFormInputComponentProcessor implements \PoP\ComponentModel\ComponentProcessors\FilterInputComponentProcessorInterface
{
    /**
     * @var \PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface|null
     */
    private $schemaDefinitionService;
    public final function setSchemaDefinitionService(SchemaDefinitionServiceInterface $schemaDefinitionService) : void
    {
        $this->schemaDefinitionService = $schemaDefinitionService;
    }
    protected final function getSchemaDefinitionService() : SchemaDefinitionServiceInterface
    {
        if ($this->schemaDefinitionService === null) {
            /** @var SchemaDefinitionServiceInterface */
            $schemaDefinitionService = $this->instanceManager->getInstance(SchemaDefinitionServiceInterface::class);
            $this->schemaDefinitionService = $schemaDefinitionService;
        }
        return $this->schemaDefinitionService;
    }
    protected function getFilterInputSchemaDefinitionResolver(Component $component) : \PoP\ComponentModel\ComponentProcessors\FilterInputComponentProcessorInterface
    {
        return $this;
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        $filterSchemaDefinitionResolver = $this->getFilterInputSchemaDefinitionResolver($component);
        if ($filterSchemaDefinitionResolver !== $this) {
            return $filterSchemaDefinitionResolver->getFilterInputTypeResolver($component);
        }
        return $this->getDefaultSchemaFilterInputTypeResolver();
    }
    protected function getDefaultSchemaFilterInputTypeResolver() : InputTypeResolverInterface
    {
        return $this->getSchemaDefinitionService()->getDefaultInputTypeResolver();
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        $filterSchemaDefinitionResolver = $this->getFilterInputSchemaDefinitionResolver($component);
        if ($filterSchemaDefinitionResolver !== $this) {
            return $filterSchemaDefinitionResolver->getFilterInputDescription($component);
        }
        return null;
    }
    /**
     * @return mixed
     */
    public function getFilterInputDefaultValue(Component $component)
    {
        $filterSchemaDefinitionResolver = $this->getFilterInputSchemaDefinitionResolver($component);
        if ($filterSchemaDefinitionResolver !== $this) {
            return $filterSchemaDefinitionResolver->getFilterInputDefaultValue($component);
        }
        return null;
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        $filterSchemaDefinitionResolver = $this->getFilterInputSchemaDefinitionResolver($component);
        if ($filterSchemaDefinitionResolver !== $this) {
            return $filterSchemaDefinitionResolver->getFilterInputTypeModifiers($component);
        }
        return SchemaTypeModifiers::NONE;
    }
}
