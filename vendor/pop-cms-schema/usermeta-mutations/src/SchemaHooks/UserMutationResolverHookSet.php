<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\SchemaHooks;

use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolverInterface;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\SchemaHooks\AbstractUserMutationResolverHookSet;
/** @internal */
class UserMutationResolverHookSet extends AbstractUserMutationResolverHookSet
{
    use \PoPCMSSchema\UserMetaMutations\SchemaHooks\UserMutationResolverHookSetTrait;
    private ?UserObjectTypeResolver $userObjectTypeResolver = null;
    protected final function getUserObjectTypeResolver() : UserObjectTypeResolver
    {
        if ($this->userObjectTypeResolver === null) {
            /** @var UserObjectTypeResolver */
            $userObjectTypeResolver = $this->instanceManager->getInstance(UserObjectTypeResolver::class);
            $this->userObjectTypeResolver = $userObjectTypeResolver;
        }
        return $this->userObjectTypeResolver;
    }
    protected function getUserTypeResolver() : UserObjectTypeResolverInterface
    {
        return $this->getUserObjectTypeResolver();
    }
}
