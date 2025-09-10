<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolverPicker;
use PoPCMSSchema\PageMutations\ObjectModels\LoggedInUserHasNoEditingPageCapabilityErrorPayload;
use PoPCMSSchema\PageMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolverPicker extends AbstractLoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolverPicker
{
    private ?LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver = null;
    protected final function getLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver() : LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoEditingPageCapabilityErrorPayload::class;
    }
}
