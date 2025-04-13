<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType\AbstractUserObjectTypeFieldResolver;
use PoPCMSSchema\UserMetaMutations\Module as UserMetaMutationsModule;
use PoPCMSSchema\UserMetaMutations\ModuleConfiguration as UserMetaMutationsModuleConfiguration;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class UserObjectTypeFieldResolver extends AbstractUserObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver|null
     */
    private $userObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $userDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $userCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $userUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\UserSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $userSetMetaMutationPayloadObjectTypeResolver;
    protected final function getUserObjectTypeResolver() : UserObjectTypeResolver
    {
        if ($this->userObjectTypeResolver === null) {
            /** @var UserObjectTypeResolver */
            $userObjectTypeResolver = $this->instanceManager->getInstance(UserObjectTypeResolver::class);
            $this->userObjectTypeResolver = $userObjectTypeResolver;
        }
        return $this->userObjectTypeResolver;
    }
    protected final function getUserDeleteMetaMutationPayloadObjectTypeResolver() : UserDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->userDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var UserDeleteMetaMutationPayloadObjectTypeResolver */
            $userDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->userDeleteMetaMutationPayloadObjectTypeResolver = $userDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->userDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getUserAddMetaMutationPayloadObjectTypeResolver() : UserAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->userCreateMutationPayloadObjectTypeResolver === null) {
            /** @var UserAddMetaMutationPayloadObjectTypeResolver */
            $userCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserAddMetaMutationPayloadObjectTypeResolver::class);
            $this->userCreateMutationPayloadObjectTypeResolver = $userCreateMutationPayloadObjectTypeResolver;
        }
        return $this->userCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getUserUpdateMetaMutationPayloadObjectTypeResolver() : UserUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->userUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var UserUpdateMetaMutationPayloadObjectTypeResolver */
            $userUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->userUpdateMetaMutationPayloadObjectTypeResolver = $userUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->userUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getUserSetMetaMutationPayloadObjectTypeResolver() : UserSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->userSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var UserSetMetaMutationPayloadObjectTypeResolver */
            $userSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserSetMetaMutationPayloadObjectTypeResolver::class);
            $this->userSetMetaMutationPayloadObjectTypeResolver = $userSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->userSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [UserObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var UserMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(UserMetaMutationsModule::class)->getConfiguration();
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        if (!$usePayloadableUserMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getUserObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getUserAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getUserDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getUserSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getUserUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
