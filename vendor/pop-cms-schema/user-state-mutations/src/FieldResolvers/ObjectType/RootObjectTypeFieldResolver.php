<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\UserStateMutations\Module;
use PoPCMSSchema\UserStateMutations\ModuleConfiguration;
use PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserOneofMutationResolver;
use PoPCMSSchema\UserStateMutations\MutationResolvers\LogoutUserMutationResolver;
use PoPCMSSchema\UserStateMutations\Constants\MutationInputProperties;
use PoPCMSSchema\UserStateMutations\MutationResolvers\PayloadableLoginUserOneofMutationResolver;
use PoPCMSSchema\UserStateMutations\MutationResolvers\PayloadableLogoutUserMutationResolver;
use PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginUserByOneofInputObjectTypeResolver;
use PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\RootLoginUserMutationPayloadObjectTypeResolver;
use PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\RootLogoutUserMutationPayloadObjectTypeResolver;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
class RootObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver|null
     */
    private $userObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserOneofMutationResolver|null
     */
    private $loginUserOneofMutationResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\MutationResolvers\LogoutUserMutationResolver|null
     */
    private $logoutUserMutationResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginUserByOneofInputObjectTypeResolver|null
     */
    private $loginUserByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\MutationResolvers\PayloadableLoginUserOneofMutationResolver|null
     */
    private $payloadableLoginUserOneofMutationResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\MutationResolvers\PayloadableLogoutUserMutationResolver|null
     */
    private $payloadableLogoutUserMutationResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\RootLoginUserMutationPayloadObjectTypeResolver|null
     */
    private $rootLoginUserMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\RootLogoutUserMutationPayloadObjectTypeResolver|null
     */
    private $rootLogoutUserMutationPayloadObjectTypeResolver;
    public final function setUserObjectTypeResolver(UserObjectTypeResolver $userObjectTypeResolver) : void
    {
        $this->userObjectTypeResolver = $userObjectTypeResolver;
    }
    protected final function getUserObjectTypeResolver() : UserObjectTypeResolver
    {
        if ($this->userObjectTypeResolver === null) {
            /** @var UserObjectTypeResolver */
            $userObjectTypeResolver = $this->instanceManager->getInstance(UserObjectTypeResolver::class);
            $this->userObjectTypeResolver = $userObjectTypeResolver;
        }
        return $this->userObjectTypeResolver;
    }
    public final function setLoginUserOneofMutationResolver(LoginUserOneofMutationResolver $loginUserOneofMutationResolver) : void
    {
        $this->loginUserOneofMutationResolver = $loginUserOneofMutationResolver;
    }
    protected final function getLoginUserOneofMutationResolver() : LoginUserOneofMutationResolver
    {
        if ($this->loginUserOneofMutationResolver === null) {
            /** @var LoginUserOneofMutationResolver */
            $loginUserOneofMutationResolver = $this->instanceManager->getInstance(LoginUserOneofMutationResolver::class);
            $this->loginUserOneofMutationResolver = $loginUserOneofMutationResolver;
        }
        return $this->loginUserOneofMutationResolver;
    }
    public final function setLogoutUserMutationResolver(LogoutUserMutationResolver $logoutUserMutationResolver) : void
    {
        $this->logoutUserMutationResolver = $logoutUserMutationResolver;
    }
    protected final function getLogoutUserMutationResolver() : LogoutUserMutationResolver
    {
        if ($this->logoutUserMutationResolver === null) {
            /** @var LogoutUserMutationResolver */
            $logoutUserMutationResolver = $this->instanceManager->getInstance(LogoutUserMutationResolver::class);
            $this->logoutUserMutationResolver = $logoutUserMutationResolver;
        }
        return $this->logoutUserMutationResolver;
    }
    public final function setLoginUserByOneofInputObjectTypeResolver(LoginUserByOneofInputObjectTypeResolver $loginUserByOneofInputObjectTypeResolver) : void
    {
        $this->loginUserByOneofInputObjectTypeResolver = $loginUserByOneofInputObjectTypeResolver;
    }
    protected final function getLoginUserByOneofInputObjectTypeResolver() : LoginUserByOneofInputObjectTypeResolver
    {
        if ($this->loginUserByOneofInputObjectTypeResolver === null) {
            /** @var LoginUserByOneofInputObjectTypeResolver */
            $loginUserByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(LoginUserByOneofInputObjectTypeResolver::class);
            $this->loginUserByOneofInputObjectTypeResolver = $loginUserByOneofInputObjectTypeResolver;
        }
        return $this->loginUserByOneofInputObjectTypeResolver;
    }
    public final function setPayloadableLoginUserOneofMutationResolver(PayloadableLoginUserOneofMutationResolver $payloadableLoginUserOneofMutationResolver) : void
    {
        $this->payloadableLoginUserOneofMutationResolver = $payloadableLoginUserOneofMutationResolver;
    }
    protected final function getPayloadableLoginUserOneofMutationResolver() : PayloadableLoginUserOneofMutationResolver
    {
        if ($this->payloadableLoginUserOneofMutationResolver === null) {
            /** @var PayloadableLoginUserOneofMutationResolver */
            $payloadableLoginUserOneofMutationResolver = $this->instanceManager->getInstance(PayloadableLoginUserOneofMutationResolver::class);
            $this->payloadableLoginUserOneofMutationResolver = $payloadableLoginUserOneofMutationResolver;
        }
        return $this->payloadableLoginUserOneofMutationResolver;
    }
    public final function setPayloadableLogoutUserMutationResolver(PayloadableLogoutUserMutationResolver $payloadableLogoutUserMutationResolver) : void
    {
        $this->payloadableLogoutUserMutationResolver = $payloadableLogoutUserMutationResolver;
    }
    protected final function getPayloadableLogoutUserMutationResolver() : PayloadableLogoutUserMutationResolver
    {
        if ($this->payloadableLogoutUserMutationResolver === null) {
            /** @var PayloadableLogoutUserMutationResolver */
            $payloadableLogoutUserMutationResolver = $this->instanceManager->getInstance(PayloadableLogoutUserMutationResolver::class);
            $this->payloadableLogoutUserMutationResolver = $payloadableLogoutUserMutationResolver;
        }
        return $this->payloadableLogoutUserMutationResolver;
    }
    public final function setRootLoginUserMutationPayloadObjectTypeResolver(RootLoginUserMutationPayloadObjectTypeResolver $rootLoginUserMutationPayloadObjectTypeResolver) : void
    {
        $this->rootLoginUserMutationPayloadObjectTypeResolver = $rootLoginUserMutationPayloadObjectTypeResolver;
    }
    protected final function getRootLoginUserMutationPayloadObjectTypeResolver() : RootLoginUserMutationPayloadObjectTypeResolver
    {
        if ($this->rootLoginUserMutationPayloadObjectTypeResolver === null) {
            /** @var RootLoginUserMutationPayloadObjectTypeResolver */
            $rootLoginUserMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootLoginUserMutationPayloadObjectTypeResolver::class);
            $this->rootLoginUserMutationPayloadObjectTypeResolver = $rootLoginUserMutationPayloadObjectTypeResolver;
        }
        return $this->rootLoginUserMutationPayloadObjectTypeResolver;
    }
    public final function setRootLogoutUserMutationPayloadObjectTypeResolver(RootLogoutUserMutationPayloadObjectTypeResolver $rootLogoutUserMutationPayloadObjectTypeResolver) : void
    {
        $this->rootLogoutUserMutationPayloadObjectTypeResolver = $rootLogoutUserMutationPayloadObjectTypeResolver;
    }
    protected final function getRootLogoutUserMutationPayloadObjectTypeResolver() : RootLogoutUserMutationPayloadObjectTypeResolver
    {
        if ($this->rootLogoutUserMutationPayloadObjectTypeResolver === null) {
            /** @var RootLogoutUserMutationPayloadObjectTypeResolver */
            $rootLogoutUserMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootLogoutUserMutationPayloadObjectTypeResolver::class);
            $this->rootLogoutUserMutationPayloadObjectTypeResolver = $rootLogoutUserMutationPayloadObjectTypeResolver;
        }
        return $this->rootLogoutUserMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['loginUser', 'logoutUser'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'loginUser':
                return $this->__('Log the user in', 'user-state-mutations');
            case 'logoutUser':
                return $this->__('Log the user out', 'user-state-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserStateMutations = $moduleConfiguration->usePayloadableUserStateMutations();
        if (!$usePayloadableUserStateMutations) {
            return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        switch ($fieldName) {
            case 'loginUser':
            case 'logoutUser':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'loginUser':
                return [MutationInputProperties::BY => $this->getLoginUserByOneofInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['loginUser' => MutationInputProperties::BY]:
                return $this->__('Choose which credentials to use to log-in, and provide them', 'user-state-mutations');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['loginUser' => MutationInputProperties::BY]:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserStateMutations = $moduleConfiguration->usePayloadableUserStateMutations();
        switch ($fieldName) {
            case 'loginUser':
                return $usePayloadableUserStateMutations ? $this->getPayloadableLoginUserOneofMutationResolver() : $this->getLoginUserOneofMutationResolver();
            case 'logoutUser':
                return $usePayloadableUserStateMutations ? $this->getPayloadableLogoutUserMutationResolver() : $this->getLogoutUserMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableUserStateMutations = $moduleConfiguration->usePayloadableUserStateMutations();
        if ($usePayloadableUserStateMutations) {
            switch ($fieldName) {
                case 'loginUser':
                    return $this->getRootLoginUserMutationPayloadObjectTypeResolver();
                case 'logoutUser':
                    return $this->getRootLogoutUserMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'loginUser':
            case 'logoutUser':
                return $this->getUserObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
