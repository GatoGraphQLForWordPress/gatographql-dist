<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Hooks;

use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface;
use PoP\ComponentModel\TypeResolvers\HookHelpers;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
abstract class AbstractRemoveFieldsFromObjectTypeHookSet extends AbstractHookSet
{
    protected function init() : void
    {
        App::addFilter(HookHelpers::getHookNameToFilterField(), \Closure::fromCallable([$this, 'filterFields']), 10, 4);
    }
    /**
     * @param \PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface|\PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface $objectTypeOrInterfaceTypeResolver
     * @param \PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface|\PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface $objectTypeOrInterfaceTypeFieldResolver
     */
    public function filterFields(bool $include, $objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeFieldResolver, string $fieldName) : bool
    {
        if (!$this->matchesCondition($objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeFieldResolver, $fieldName)) {
            return $include;
        }
        $objectTypeOrInterfaceTypeResolverClass = $this->getObjectTypeOrInterfaceTypeResolverClass();
        if (\is_a($objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeResolverClass, \true)) {
            return \false;
        }
        return $include;
    }
    /**
     * @param \PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface|\PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface $objectTypeOrInterfaceTypeResolver
     * @param \PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface|\PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface $objectTypeOrInterfaceTypeFieldResolver
     */
    protected abstract function matchesCondition($objectTypeOrInterfaceTypeResolver, $objectTypeOrInterfaceTypeFieldResolver, string $fieldName) : bool;
    /**
     * @phpstan-return class-string<ObjectTypeResolverInterface|InterfaceTypeResolverInterface>
     */
    protected abstract function getObjectTypeOrInterfaceTypeResolverClass() : string;
}
