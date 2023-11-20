<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayload;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver|null
     */
    private $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
    public final function setLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver(LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver) : void
    {
        $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
    }
    protected final function getLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver() : LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoPublishingCustomPostCapabilityErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoPublishingCustomPostCapabilityErrorPayload::class;
    }
}
