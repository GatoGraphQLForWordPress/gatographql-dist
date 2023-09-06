<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\MutationResolvers;

use PoP\ComponentModel\MutationResolvers\AbstractOneofMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
class LoginUserOneofMutationResolver extends AbstractOneofMutationResolver
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserByCredentialsMutationResolver|null
     */
    private $loginUserByCredentialsMutationResolver;
    public final function setLoginUserByCredentialsMutationResolver(\PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserByCredentialsMutationResolver $loginUserByCredentialsMutationResolver) : void
    {
        $this->loginUserByCredentialsMutationResolver = $loginUserByCredentialsMutationResolver;
    }
    protected final function getLoginUserByCredentialsMutationResolver() : \PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserByCredentialsMutationResolver
    {
        if ($this->loginUserByCredentialsMutationResolver === null) {
            /** @var LoginUserByCredentialsMutationResolver */
            $loginUserByCredentialsMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserStateMutations\MutationResolvers\LoginUserByCredentialsMutationResolver::class);
            $this->loginUserByCredentialsMutationResolver = $loginUserByCredentialsMutationResolver;
        }
        return $this->loginUserByCredentialsMutationResolver;
    }
    /**
     * @return array<string,MutationResolverInterface>
     */
    protected function getInputFieldNameMutationResolvers() : array
    {
        return ['credentials' => $this->getLoginUserByCredentialsMutationResolver()];
    }
}
