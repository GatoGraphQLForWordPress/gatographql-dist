<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver $loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver = null;
    protected final function getLoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver() : LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver = $loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoPermissionToDeleteMediaItemErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoPermissionToDeleteMediaItemErrorPayload::class;
    }
}
