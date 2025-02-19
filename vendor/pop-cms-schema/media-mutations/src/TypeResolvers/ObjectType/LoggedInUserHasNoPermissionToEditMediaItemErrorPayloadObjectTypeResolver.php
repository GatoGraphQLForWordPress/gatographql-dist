<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoPermissionToEditMediaItemErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The user has no permission to edit the media item"', 'media-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoPermissionToEditMediaItemErrorPayloadObjectTypeDataLoader();
    }
}
