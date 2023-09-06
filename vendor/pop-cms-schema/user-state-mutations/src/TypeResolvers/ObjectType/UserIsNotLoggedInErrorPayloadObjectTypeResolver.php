<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\UserIsNotLoggedInErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
class UserIsNotLoggedInErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\UserIsNotLoggedInErrorPayloadObjectTypeDataLoader|null
     */
    private $userIsNotLoggedInErrorPayloadObjectTypeDataLoader;
    public final function setUserIsNotLoggedInErrorPayloadObjectTypeDataLoader(UserIsNotLoggedInErrorPayloadObjectTypeDataLoader $userIsNotLoggedInErrorPayloadObjectTypeDataLoader) : void
    {
        $this->userIsNotLoggedInErrorPayloadObjectTypeDataLoader = $userIsNotLoggedInErrorPayloadObjectTypeDataLoader;
    }
    protected final function getUserIsNotLoggedInErrorPayloadObjectTypeDataLoader() : UserIsNotLoggedInErrorPayloadObjectTypeDataLoader
    {
        if ($this->userIsNotLoggedInErrorPayloadObjectTypeDataLoader === null) {
            /** @var UserIsNotLoggedInErrorPayloadObjectTypeDataLoader */
            $userIsNotLoggedInErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(UserIsNotLoggedInErrorPayloadObjectTypeDataLoader::class);
            $this->userIsNotLoggedInErrorPayloadObjectTypeDataLoader = $userIsNotLoggedInErrorPayloadObjectTypeDataLoader;
        }
        return $this->userIsNotLoggedInErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UserIsNotLoggedInErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The user is not logged-in"', 'user-state-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserIsNotLoggedInErrorPayloadObjectTypeDataLoader();
    }
}
