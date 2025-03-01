<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
use PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeResolver extends LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoPublishingPageCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to publish pages"', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
