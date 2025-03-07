<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver|null
     */
    private $loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver;
    protected final function getLoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver() : LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload::class;
    }
}
