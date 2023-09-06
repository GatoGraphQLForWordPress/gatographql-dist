<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
abstract class AbstractUseRootAsSourceForSchemaObjectTypeResolver extends AbstractObjectTypeResolver implements \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\UseRootAsSourceForSchemaObjectTypeResolverInterface
{
    /**
     * @var \PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver|null
     */
    private $rootObjectTypeResolver;
    public final function setRootObjectTypeResolver(RootObjectTypeResolver $rootObjectTypeResolver) : void
    {
        $this->rootObjectTypeResolver = $rootObjectTypeResolver;
    }
    protected final function getRootObjectTypeResolver() : RootObjectTypeResolver
    {
        if ($this->rootObjectTypeResolver === null) {
            /** @var RootObjectTypeResolver */
            $rootObjectTypeResolver = $this->instanceManager->getInstance(RootObjectTypeResolver::class);
            $this->rootObjectTypeResolver = $rootObjectTypeResolver;
        }
        return $this->rootObjectTypeResolver;
    }
    protected function getTypeResolverToCalculateSchema() : RelationalTypeResolverInterface
    {
        return $this->getRootObjectTypeResolver();
    }
    /**
     * @param \PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface|\PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface $objectTypeOrInterfaceTypeResolver
     * @param \PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface|\PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface $objectTypeOrInterfaceTypeFieldResolver
     */
    protected function isFieldNameResolvedByObjectTypeFieldResolver($objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeFieldResolver, string $fieldName) : bool
    {
        if ($objectTypeOrInterfaceTypeFieldResolver instanceof ObjectTypeFieldResolverInterface && !$this->isFieldNameConditionSatisfiedForSchema($objectTypeOrInterfaceTypeFieldResolver, $fieldName)) {
            return \false;
        }
        return parent::isFieldNameResolvedByObjectTypeFieldResolver($objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeFieldResolver, $fieldName);
    }
}
