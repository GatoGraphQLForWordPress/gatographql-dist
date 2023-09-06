<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\UserIsNotLoggedInErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
abstract class AbstractUserIsNotLoggedInErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType\UserIsNotLoggedInErrorPayloadObjectTypeResolver|null
     */
    private $userIsNotLoggedInErrorPayloadObjectTypeResolver;
    public final function setUserIsNotLoggedInErrorPayloadObjectTypeResolver(UserIsNotLoggedInErrorPayloadObjectTypeResolver $userIsNotLoggedInErrorPayloadObjectTypeResolver) : void
    {
        $this->userIsNotLoggedInErrorPayloadObjectTypeResolver = $userIsNotLoggedInErrorPayloadObjectTypeResolver;
    }
    protected final function getUserIsNotLoggedInErrorPayloadObjectTypeResolver() : UserIsNotLoggedInErrorPayloadObjectTypeResolver
    {
        if ($this->userIsNotLoggedInErrorPayloadObjectTypeResolver === null) {
            /** @var UserIsNotLoggedInErrorPayloadObjectTypeResolver */
            $userIsNotLoggedInErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserIsNotLoggedInErrorPayloadObjectTypeResolver::class);
            $this->userIsNotLoggedInErrorPayloadObjectTypeResolver = $userIsNotLoggedInErrorPayloadObjectTypeResolver;
        }
        return $this->userIsNotLoggedInErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getUserIsNotLoggedInErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return UserIsNotLoggedInErrorPayload::class;
    }
}
