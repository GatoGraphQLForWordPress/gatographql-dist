<?php

declare(strict_types=1);

namespace PoPCMSSchema\UserRolesWP\Overrides\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\UserRolesWP\TypeResolvers\ObjectType\UserRoleObjectTypeResolver;

trait RolesObjectTypeFieldResolverTrait
{
    abstract protected function getUserRoleObjectTypeResolver(): UserRoleObjectTypeResolver;

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'roles':
                return $this->getUserRoleObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
