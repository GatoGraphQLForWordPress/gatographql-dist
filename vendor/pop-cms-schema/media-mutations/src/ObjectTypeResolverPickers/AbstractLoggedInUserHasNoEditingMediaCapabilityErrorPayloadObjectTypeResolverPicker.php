<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\LoggedInUserHasNoEditingMediaCapabilityErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver|null
     */
    private $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver;
    protected final function getLoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver() : LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoEditingMediaCapabilityErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoEditingMediaCapabilityErrorPayload::class;
    }
}
