<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofInputObjectTypeResolver;
/** @internal */
class LoginUserByOneofInputObjectTypeResolver extends AbstractOneofInputObjectTypeResolver
{
    private ?\PoPCMSSchema\UserStateMutations\TypeResolvers\InputObjectType\LoginCredentialsInputObjectTypeResolver $loginCredentialsInputObjectTypeResolver = null;
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
        return match ($inputFieldName) {
            'credentials' => $this->__('Login using the website credentials', 'user-state-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
}
