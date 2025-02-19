<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoEditingMediaCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The user cannot edit media items"', 'polylang-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
