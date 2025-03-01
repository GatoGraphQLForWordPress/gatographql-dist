<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface;
use PoP\ComponentModel\Resolvers\QueryableFieldResolverTrait;
/** @internal */
abstract class AbstractQueryableSchemaInterfaceTypeFieldResolver extends \PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver implements \PoP\ComponentModel\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldSchemaDefinitionResolverInterface
{
    use QueryableFieldResolverTrait;
    /**
     * @var \PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface|null
     */
    private $componentProcessorManager;
    protected final function getComponentProcessorManager() : ComponentProcessorManagerInterface
    {
        if ($this->componentProcessorManager === null) {
            /** @var ComponentProcessorManagerInterface */
            $componentProcessorManager = $this->instanceManager->getInstance(ComponentProcessorManagerInterface::class);
            $this->componentProcessorManager = $componentProcessorManager;
        }
        return $this->componentProcessorManager;
    }
    public function getFieldFilterInputContainerComponent(string $fieldName) : ?Component
    {
        /**
         * An interface may implement another interface which is not Queryable
         */
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($fieldName);
        if (!$schemaDefinitionResolver instanceof \PoP\ComponentModel\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldSchemaDefinitionResolverInterface) {
            return null;
        }
        /** @var QueryableInterfaceTypeFieldSchemaDefinitionResolverInterface $schemaDefinitionResolver */
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getFieldFilterInputContainerComponent($fieldName);
        }
        return null;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(string $fieldName) : array
    {
        if ($filterDataloadingComponent = $this->getFieldFilterInputContainerComponent($fieldName)) {
            return $this->getFilterFieldArgNameTypeResolvers($filterDataloadingComponent);
        }
        return parent::getFieldArgNameTypeResolvers($fieldName);
    }
    public function getFieldArgDescription(string $fieldName, string $fieldArgName) : ?string
    {
        if ($filterDataloadingComponent = $this->getFieldFilterInputContainerComponent($fieldName)) {
            return $this->getFilterFieldArgDescription($filterDataloadingComponent, $fieldArgName);
        }
        return parent::getFieldArgDescription($fieldName, $fieldArgName);
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(string $fieldName, string $fieldArgName)
    {
        if ($filterDataloadingComponent = $this->getFieldFilterInputContainerComponent($fieldName)) {
            return $this->getFilterFieldArgDefaultValue($filterDataloadingComponent, $fieldArgName);
        }
        return parent::getFieldArgDefaultValue($fieldName, $fieldArgName);
    }
    public function getFieldArgTypeModifiers(string $fieldName, string $fieldArgName) : int
    {
        if ($filterDataloadingComponent = $this->getFieldFilterInputContainerComponent($fieldName)) {
            return $this->getFilterFieldArgTypeModifiers($filterDataloadingComponent, $fieldArgName);
        }
        return parent::getFieldArgTypeModifiers($fieldName, $fieldArgName);
    }
}
