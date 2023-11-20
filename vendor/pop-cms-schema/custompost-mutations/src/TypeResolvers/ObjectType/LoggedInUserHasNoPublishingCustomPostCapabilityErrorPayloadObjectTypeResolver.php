<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader;
    public final function setLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader(LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader) : void
    {
        $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader;
    }
    protected final function getLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to publish custom posts"', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
