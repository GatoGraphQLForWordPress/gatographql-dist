<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Resolvers;

use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
trait FieldOrDirectiveSchemaDefinitionResolverTrait
{
    use \PoP\ComponentModel\Resolvers\TypeSchemaDefinitionResolverTrait;
    /**
     * @return array<string,mixed>
     * @param mixed $argDefaultValue
     */
    public final function getFieldOrDirectiveArgTypeSchemaDefinition(string $argName, InputTypeResolverInterface $argInputTypeResolver, ?string $argDescription, $argDefaultValue, int $argTypeModifiers) : array
    {
        return $this->getTypeSchemaDefinition($argName, $argInputTypeResolver, $argDescription, $argDefaultValue, $argTypeModifiers);
    }
    /**
     * @return array<string,mixed>
     */
    public final function getFieldTypeSchemaDefinition(string $fieldName, ConcreteTypeResolverInterface $fieldTypeResolver, ?string $fieldDescription, int $fieldTypeModifiers, ?string $fieldDeprecationMessage) : array
    {
        return $this->getTypeSchemaDefinition($fieldName, $fieldTypeResolver, $fieldDescription, null, $fieldTypeModifiers, $fieldDeprecationMessage);
    }
}
