<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    private ?LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader $loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader = null;
    protected final function getLoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoPermissionToEditMenuErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The user has no permission to edit the menu"', 'menu-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoPermissionToEditMenuErrorPayloadObjectTypeDataLoader();
    }
}
