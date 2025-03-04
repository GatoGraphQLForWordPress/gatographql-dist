<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\UserDoesNotExistErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class UserDoesNotExistErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\UserDoesNotExistErrorPayloadObjectTypeDataLoader|null
     */
    private $userDoesNotExistErrorPayloadObjectTypeDataLoader;
    protected final function getUserDoesNotExistErrorPayloadObjectTypeDataLoader() : UserDoesNotExistErrorPayloadObjectTypeDataLoader
    {
        if ($this->userDoesNotExistErrorPayloadObjectTypeDataLoader === null) {
            /** @var UserDoesNotExistErrorPayloadObjectTypeDataLoader */
            $userDoesNotExistErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(UserDoesNotExistErrorPayloadObjectTypeDataLoader::class);
            $this->userDoesNotExistErrorPayloadObjectTypeDataLoader = $userDoesNotExistErrorPayloadObjectTypeDataLoader;
        }
        return $this->userDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UserDoesNotExistErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The user does not exist"', 'media-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserDoesNotExistErrorPayloadObjectTypeDataLoader();
    }
}
