<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoPermissionToEditCustomPostErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to edit the requested custom post"', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeDataLoader();
    }
}
