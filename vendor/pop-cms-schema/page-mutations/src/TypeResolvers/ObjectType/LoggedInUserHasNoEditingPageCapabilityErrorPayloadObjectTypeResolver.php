<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver;
use PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver extends LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoEditingPageCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to edit pages"', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
