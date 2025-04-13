<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\FieldResolvers\ObjectType\AbstractRootUserCRUDObjectTypeFieldResolver;
use PoPCMSSchema\UserMetaMutations\Module;
use PoPCMSSchema\UserMetaMutations\ModuleConfiguration;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootAddUserMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootDeleteUserMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootSetUserMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootUpdateUserMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootUserCRUDObjectTypeFieldResolver extends AbstractRootUserCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver|null
     */
    private $userObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootDeleteUserMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteUserMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootSetUserMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetUserMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootUpdateUserMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateUserMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\RootAddUserMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddUserMetaMutationPayloadObjectTypeResolver;
    protected final function getUserObjectTypeResolver() : UserObjectTypeResolver
    {
        if ($this->userObjectTypeResolver === null) {
            /** @var UserObjectTypeResolver */
            $userObjectTypeResolver = $this->instanceManager->getInstance(UserObjectTypeResolver::class);
            $this->userObjectTypeResolver = $userObjectTypeResolver;
        }
        return $this->userObjectTypeResolver;
    }
    protected final function getRootDeleteUserMetaMutationPayloadObjectTypeResolver() : RootDeleteUserMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteUserMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteUserMetaMutationPayloadObjectTypeResolver */
            $rootDeleteUserMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteUserMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteUserMetaMutationPayloadObjectTypeResolver = $rootDeleteUserMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteUserMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetUserMetaMutationPayloadObjectTypeResolver() : RootSetUserMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetUserMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetUserMetaMutationPayloadObjectTypeResolver */
            $rootSetUserMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetUserMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetUserMetaMutationPayloadObjectTypeResolver = $rootSetUserMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetUserMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateUserMetaMutationPayloadObjectTypeResolver() : RootUpdateUserMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateUserMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateUserMetaMutationPayloadObjectTypeResolver */
            $rootUpdateUserMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateUserMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateUserMetaMutationPayloadObjectTypeResolver = $rootUpdateUserMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateUserMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddUserMetaMutationPayloadObjectTypeResolver() : RootAddUserMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddUserMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddUserMetaMutationPayloadObjectTypeResolver */
            $rootAddUserMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddUserMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddUserMetaMutationPayloadObjectTypeResolver = $rootAddUserMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddUserMetaMutationPayloadObjectTypeResolver;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserMetaMutations = $moduleConfiguration->usePayloadableUserMetaMutations();
        if ($usePayloadableUserMetaMutations) {
            switch ($fieldName) {
                case 'addUserMeta':
                case 'addUserMetas':
                case 'addUserMetaMutationPayloadObjects':
                    return $this->getRootAddUserMetaMutationPayloadObjectTypeResolver();
                case 'updateUserMeta':
                case 'updateUserMetas':
                case 'updateUserMetaMutationPayloadObjects':
                    return $this->getRootUpdateUserMetaMutationPayloadObjectTypeResolver();
                case 'deleteUserMeta':
                case 'deleteUserMetas':
                case 'deleteUserMetaMutationPayloadObjects':
                    return $this->getRootDeleteUserMetaMutationPayloadObjectTypeResolver();
                case 'setUserMeta':
                case 'setUserMetas':
                case 'setUserMetaMutationPayloadObjects':
                    return $this->getRootSetUserMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addUserMeta':
            case 'addUserMetas':
            case 'updateUserMeta':
            case 'updateUserMetas':
            case 'deleteUserMeta':
            case 'deleteUserMetas':
            case 'setUserMeta':
            case 'setUserMetas':
                return $this->getUserObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
