<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers\ObjectType;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
interface QueryableObjectTypeFieldSchemaDefinitionResolverInterface extends \PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldSchemaDefinitionResolverInterface
{
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component;
}
