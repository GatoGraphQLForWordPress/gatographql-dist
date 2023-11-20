<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofInputObjectTypeResolver;
/** @internal */
class LoginUserByOneofInputObjectTypeResolver extends AbstractOneofInputObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginCredentialsInputObjectTypeResolver|null
     */
    private $loginCredentialsInputObjectTypeResolver;
    public final function setLoginCredentialsInputObjectTypeResolver(\PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginCredentialsInputObjectTypeResolver $loginCredentialsInputObjectTypeResolver) : void
    {
        $this->loginCredentialsInputObjectTypeResolver = $loginCredentialsInputObjectTypeResolver;
    }
    protected final function getLoginCredentialsInputObjectTypeResolver() : \PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginCredentialsInputObjectTypeResolver
    {
        if ($this->loginCredentialsInputObjectTypeResolver === null) {
            /** @var LoginCredentialsInputObjectTypeResolver */
            $loginCredentialsInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginCredentialsInputObjectTypeResolver::class);
            $this->loginCredentialsInputObjectTypeResolver = $loginCredentialsInputObjectTypeResolver;
        }
        return $this->loginCredentialsInputObjectTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'LoginUserByInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['credentials' => $this->getLoginCredentialsInputObjectTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'credentials':
                return $this->__('Login using the website credentials', 'user-state-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
